# RDFBrowser
A Linked Data content negotiation and publication platform coded in PHP for consumer level applications.

# Installation instructions
This is an application developed with Laravel MVC PHP Framework. Follow these instructions to succesfully install the app.
Server requirements:

   - PHP >= 5.6.4
   - OpenSSL PHP Extension
   - PDO PHP Extension
   - Mbstring PHP Extension
   - Tokenizer PHP Extension
   - XML PHP Extension

```sh
# clone the repo on a folder of your choice, usually /home/$user

$ git clone https://github.com/okgreece/RDFBrowser.git

$ cd RDFBrowser

# build dependencies
$ composer install

# copy or move folder on your public folder usually /var/www 
$ cd ..
$ cp -r RDFBrowser/ /var/www/RDFBrowser

#...or create a simlink to it

# on the root folder execute
$ php artisan key:generate

# if you want to test with development server execute
$ php artisan serve

# on your browser go to http://localhost:8000/admin
```

Please, take care to make appropriate changes when you use different folders, or if you don't have wright permissions on the public folder. 

Go to http://yourdomain/admin. It will redirect you at the login page. 

Use username : admin@admin.com
        pass : admin1
        
Remember to change these settings after first login.

Then go to Endpoint section. It defaults to DBpedia SPARQL Endpoint as NON working example. You should change at least the URL of your Endpoint to reflect your configuration. 

Enjoy your new Linked Data Application!!!

# Quickstart & Shared Hosting

You can choose the pre-built releases on [Pre-Built Releases and Source Code](https://github.com/okgreece/RDFBrowser/releases/) if you want to quickstart your new app. Just extract the zipped files, change Endpoint AND User Login settings and you are ready to go!


# NGINX
It hasn't been tested yet with nginx server but this guide could be useful :
[Laravel on NGINX](https://www.digitalocean.com/community/tutorials/how-to-install-laravel-with-an-nginx-web-server-on-ubuntu-14-04)

# Docker
This is a first attemp to dockerize the application. [Laradock](https://github.com/LaraDock/laradock) is used for this purpose, as a submodule.
to install Laradock along with RDFBrowser clone the repo with the following command.
```bash
git clone --recursive -j8 https://github.com/okgreece/RDFBrowser.git
```
This command will clone both the RDFBrowser and Laradock. 

Next step is to set up the environment. 

```bash
#get inside the folder
cd laradock

#run docker-compose to get nginx
docker-compose up -d nginx
```

# Themes
If you want to use a theme different by the default, deploy your theme on resources/themes folder. 

Then edit your .env file and add the APP_THEME directive to match your theme folder name. 

Copy any additional assets on the public folder. 

Run the following commands to refresh your views
```
php artisan config:clear
php artisan view:clear
```

Enjoy your new theme!
