### Assessment project for a company

### Install

`composer install`

#### Make sure to copy .env.example file and save it as .env and change database name with your preference.

### Create application key

`php artisan key:generate`

### Migrate the database.

`php artisan migrate`

#### Install frontend dependencies.

`npm install`

#### Make sure to create a "images" folder in "storage/app/public", copy same size images to the folder. These images belong to products. They will be assigned automatically. Then run;

`php artisan storage:link`

#### Seed the database.

`php artisan db:seed`

#### And finally run.

`npm run prod`

### There is caching implemented, so configure redis to work properly in your machine.
