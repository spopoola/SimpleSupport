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
   
* Execute migrations
`php artisan migrate`

* Run the seeder table to populate the database
  `php artisan db:seed --class=UsersTableSeeder`
  `php artisan db:seed --class=TicketsTableSeeder`
  
* Compile assets: `npm run dev`


## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Vue JS](https://vuejs.org/) - The Progressive JavaScript Framework
* [NPM](https://www.npmjs.com/) - Package manager for JavaScript
* [Axios](https://github.com/mzabriskie/axios) - Promise based HTTP client for the browser and node.js