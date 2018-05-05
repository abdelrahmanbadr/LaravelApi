## Run App
php artisan serve

* In your .env file set BREWERYDB API key in BREWERYDB_API_KEY and QUEUE_DRIVER = database
* make mysql database and put it's data to .env file for queue operation.

### Queue:
* To run queue operation you should run php artisan queue:work

### Unit Test:
* To run unittest you should run vendor/bin/phpunit


