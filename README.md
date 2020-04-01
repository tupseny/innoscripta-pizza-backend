![screenshot](screenshots/backt-header.png)

# DESCRITION
Innoscripta's test work. This is backend part. 
Front is located in - [Other repository](https://github.com/tupseny/innoscripta-pizza-frontend)

# HOW TO RUN
## Environment values
### Other:
- **APP_KEY** - any string;
### Using MySql:
- **DB_HOST** - database host server (def: 127.0.0.1)
- **DB_PORT** - database port (def: 3306)
- **DB_DATABASE** - database name
- **DB_USERNAME** - database access username
- **DB_PASSWORD** - database access password
- **DB_CONNECTION** - set 'mysql' or empty

You can use my testing MySql DB. Connecting data is located in `/config/db_creds.txt`

## Front files
- Update `package.json` with dependencies ***(!don't replace)***
- Place all resource files into `resource` folder in root (JavaScript into `resources/js`, Styles into `resources/sass`)
- Configure start points for JS and CSS in `webpack.mix.js`
- Link start points for JS and CSS to index view - `resources/views/welcome.blade.php`
- Add static files (for ex. images) to `public` folder

## Commands
### Front
1. Run in project root folder `composer install && npm install`
2. Run `npm run dev|prod` to build front files to `public` folder

### Back
1. Create DB tables by `php artisan migrate` _(if new db)_
2. Insert testing data by `php artisan db:seed` _(if new db)_
