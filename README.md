Script for downloading and keeping up to date companies data from Commercial Register of Estonia.
Data is stored locally in SQLite database. The script must be executed periodically in order to 
keep the data in sync.


SQLite was chosen because it is simple and usable in wide range of applications. Even in websites.
According to SQLite documentation _"Generally speaking, any site that gets fewer than 100K hits/day 
should work fine with SQLite." ([source](https://www.sqlite.org/whentouse.html))_

# Compatibility

PHP ^8.0

# Usage


```bash
$ php ./vendor/bin/sync-est-companies.php <database> <table>
```

The `<database>` must be the absolute path to an SQLite database. If it does not exist then it will be created.
The `<table>` name must be the name of the table where Estonian companies' data is fetched. The script
will create the table by itself with proper structure.


