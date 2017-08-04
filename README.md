# Simple Support

SimpleSupport is an open source Support Ticket Management application created for small support teams

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.


### Installing

* Clone the repository 
  `git@github.com:spopoola/SimpleSupport.git`
  
* Install packages 
  `composer install`
  
* Install Front-end dependencies using yarn. You can install yarn with `npm install -g yarn`
   In the application root type in `yarn`
 
* Create your `.env` file and add Database details

* Generate your application key
`php artisan key:generate`  

* Execute migrations
`php artisan migrate`

  
* Compile assets: `npm run dev`

# Sample Data
You Run the seeder table to populate the database by running the following;

  `php artisan db:seed --class=UsersTableSeeder`
  
  `php artisan db:seed --class=TicketsTableSeeder`

Once the tables are populated, you can log in with the sample user;

email: `support@simplesupport.com`
Password: `support`


## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Vue JS](https://vuejs.org/) - The Progressive JavaScript Framework
* [NPM](https://www.npmjs.com/) - Package manager for JavaScript
* [Axios](https://github.com/mzabriskie/axios) - Promise based HTTP client for the browser and node.js
