<?php

namespace App\Exports;

use App\Document;
use Maatwebsite\Excel\Concerns\FromArray;

class DocumentsExport implements FromArray
{
    protected $documents;

    public function __construct(array $documents)
    {
        $this->documents = $documents;
    }

    public function array(): array
    {
        return $this->documents;
    }
}
