# HOW TO RUN
### Environment values
#### Using MySql:
- **DB_HOST** - database host server (def: 127.0.0.1)
- **DB_PORT** - database port (def: 3306)
- **DB_DATABASE** - database name
- **DB_USERNAME** - database access username
- **DB_PASSWORD** - database access password
- **DB_CONNECTION** - set 'mysql' or empty

You can use my testing MySql DB. Connection data is located in `/config/db_creds.txt`

### Commands
1. Run in project root folder `composer install && npm install`
2. Create DB tables by `php artisan migrate`
