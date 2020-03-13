<?php

namespace App\Console\Commands;

use App\Exports\DocumentsExport;
use App\Imports\DocumentsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Goutte\Client;

class ImportExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = base_path() . '/File.xlsx';
        $file = Excel::toArray(new DocumentsImport, $filePath);

        foreach ($file as $key => $sheet) {
            $titleList = [];
            unset($sheet[0]);
            $sheet = [$sheet[1]];
            foreach ($sheet as $row) {
                $imaUrl = 'https://ima.goo.ne.jp' . $row[1];
                $this->info('Crawling: ' . $imaUrl);
                try {
                    $client = new Client();
                    $crawler = $client->request('GET', $imaUrl);
                    $referenceUrl = $crawler->filter('.reference')->first()->attr('href');

                    if (empty($referenceUrl)) {
                        $titleList[] = [
                            $row[0],
                            ''
                        ];
                        $this->alert('Can not get reference url: ' . $row[0]);
                        continue;
                    }

                    $referenceUrlCrawler = $client->request('GET', $referenceUrl);
                    $title = $referenceUrlCrawler->filter('title')->first()->text();

                    if (empty($title)) {
                        $titleList[] = [
                            $row[0],
                            ''
                        ];
                        $this->alert('Can not get title: ' . $referenceUrl . ' of IMA post: ' . $row[0]);
                        continue;
                    }

                    $titleList[] = [
                        $row[0],
                        $title
                    ];

                    $this->info('Get title successfully: ' . $title);
                } catch (\Exception $e) {
                    $titleList[] = [
                        $row[0],
                        ''
                    ];
                    $this->alert('Can not get title: ' . $referenceUrl . ' of IMA post: ' . $row[0]);
                    $this->alert($e->getMessage());
                    Log::info($e->getMessage());
                }
            }

            Excel::store(new DocumentsExport($titleList), 'documents' . $key . '.xlsx');
        }
    }
}
