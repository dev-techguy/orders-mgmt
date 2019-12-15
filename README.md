## Orders Management Application
This is a simple application for managing orders, build using [Laravel php](https://laravel.com), [Vue js](https://vuejs.org) and [TailwindCss](https://tailwindcss.com)

### Requirements
PHP 7.2+, Nodejs v8.9+ are required to run it locally

### Demo
Click [here](https://adcash.tosinsoremekun.com/) for a live demo of this application. **PLEASE NOTE:** Sometimes, adblockers prevent certain styles and scripts from loading. In case nothing is displayed when you load the page, disable your adblock program and refresh the page.


![Demo](https://tosinsoremekun.s3.eu-central-1.amazonaws.com/Screen+Shot+2019-12-15+at+5.51.13+AM.png)


### Usage guide
The application consists of three main sections:
    - Add New Order where you can add a new order
    - Search & Filter: where you can filter by time intervals and search by product or user name
    - Order Listing: where you can view, edit, and delete an order
    
#### Add New Order
To add a new order;
    - select a user
    - select a product
    - enter the quantity and click add.
    
You should see the order listed in the order listing table

#### Deleting an Order
Click the delete link at the end of each order to delete it. You will be prompted to confirm the action.

#### Editing an order
You can edit the quantity recorded against an order by clicking the edit link at the end of the order. You cannot update the user and product of an order. You should delete the order instead if you need to change anything aside the quantity.

For ease of use, double click on the quantity to edit the order.

### Running the application locally

   - Clone this repository to your machine.
   - Install all composer dependencies. Run `composer install`.
   - Create a `.env` file, and copy the contents of `.env.example` into it.
   - Run `php artisan key:generate` to generate your application encryption keys.
   - Create a new database and name it whatever you like. Let's say `adcash`.
   - Add your database name to the `DB_DATABASE` section of your `.env` file. Also edit the `DB_USERNAME` and `DB_PASSWORD` fields appropriately. You should have something like this;
   ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=adcash
    DB_USERNAME=*****
    DB_PASSWORD=*****
   ```
   - Run `php artisan migrate --seed` to create all your database tables and load relevant data (users and products).
   - Install all `npm` dependencies. Run `npm install`.
   - Run `npm run dev` to compile all files.
   - Finally run `php artisan serve`. Your application should now be running at `http://localhost:8000`.
   
If you already use laravel valet, you can skip the last step.


### Tests
To run all automated tests, run `phpunit` or `./vendor/bin/phpunit` if you do not have phpunit installed globally.
