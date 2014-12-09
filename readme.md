#SHOPS Caribbean Mapping Application
A site to reproduce the functionality of a number or equivalent Access databases used by the Ministries of Health for Caribbean nations.

# System Requirements

* PHP 5.4 or greater
* OS level mcrypt utility
* The PHP5 mcrypt extension
* MySQL
* SSH access to server
* Git 
* The PHP Composer Utility
* Apache's mod_write enabled

# Frameworks Used
* Front end: Bootstrap Ace Theme [http://wrapbootstrap.com/preview/WB0B30DGR](http://wrapbootstrap.com/preview/WB0B30DGR)
* Back end: Laravel [http://laravel.com/](http://laravel.com/)

# Installation Instructions

3. If it is not already, install the OS level "mcyrpt" utility

        sudo apt-get install mcrypt

4. If it is not already, install and enable the PHP5 "mcrypt" extension

        sudo apt-get install php5-mcrypt
        sudo php5enmod mcrypt

3. If it is not already, install the git version control tool

        sudo apt-get install git

3. cd into your server's web directory and pull down the project repository

        git clone git@bitbucket.org:abtassociates/caribbeanmfl.git

4. Make sure Git will not alter file permissions

        git config --global core.fileMode false

4. update your server to point web requests to the "public" directory within the repo you just cloned. Note that this application MUST run at its own domain or subdomain. It can not work in a directory of another site.
5. Ensure that whatever user your web server is running as (usually 'www-data') has read/write access to the directories "app/storage" and "app/public/assets/img/custom_logo"
6. Ensure that "mod_rewrite" is enabled on your server

        sudo a2enmod rewrite
        sudo service apache2 restart

7. Ensure that Apache is allowing mod_rewrite on the specific host or vhost serving the site by adding the following inside the relevant VirtualHost block:

        <Directory "/path/to/repository/public">
            AllowOverride All
        </Directory>

5. install composer and make sure you have the "composer.phar" file in your /usr/bin folder [(instructions)](https://getcomposer.org/doc/00-intro.md#installation-nix)
6. cd into the repo and get the project to fetch it's dependencies

        composer install --no-dev

7. create a new mysql database for the site to use
8. in the directory "app/config/local" make copies of each existent file with the suffix "_example" removed
9. in the new file "app/config/local/app.php", change the base url
10. in the new file "app/config/local/database.php", change the mysql database credentials
11. in the new file "app/config/local/mail.php", change values as appropriate to your smtp server. You may also use Google's server at first to get things working ([instructions](https://www.digitalocean.com/community/tutorials/how-to-use-google-s-smtp-server)). Note that SMTP values MUST be set for the site to work properly.
12. cd into the repo root and bring the database up to date with

        php artisan migrate

13. still in the repo root, set up your first admin user

        php artisan admin:create

14. Obtain a Google Maps V3 API key [(instructions)](https://developers.google.com/maps/documentation/javascript/tutorial#api_key)
15. in a web browser, login with the admin credentials you just created and navigate to the "Settings" page of the site and enter your new Google maps API key. Also change all the rest of the values as appropriate including the proper default pan and zoom for your map, then hit "Save"
