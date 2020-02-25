FROM kenini1805/laravel-workspace

 # Install supervisor
RUN apt-get update && apt-get install -y supervisor

 # Add laravel worker configuration
COPY supervisor/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf

 # Create laravel worker log
RUN mkdir -p /var/www/laravel/storage/logs && touch /var/www/laravel/storage/logs/worker.log

 # Enable laravel worker configuration
RUN service supervisor start && supervisorctl reread && supervisorctl update && supervisorctl start laravel-worker:*

 ENTRYPOINT service supervisor start && /bin/bash
