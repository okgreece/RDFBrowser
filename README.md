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

# E-mail 
RDFBrowser uses e-mail to sent reset password links. Thus, in order for this to work you have to configure the mailing function. Laravel offers a large set of options. The easiest one is to use Google's SMTP servers. Thus all e-mails will be sent using your personal account or one you may create especially for your deployment. 

In order to use Gmail SMTP servers go to (Gmail)[https://security.google.com/settings/security/apppasswords] and create an app password. This way you will not have to worry about giving your password or problems if you have set up 2-step verification.
After you have created the APP password go to your .env file and use a similar entry as below.
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=myemail@gmail.com
MAIL_PASSWORD=app_password
MAIL_ENCRYPTION=tls
```
where you have to change just the MAIL_USERNAME and MAIL_PASSWORD. The latter is the APP password you had created earlier. Restart your App and check your settings. 

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

# Landing Page
You are hungry for resources. You don't know what to look for. You prefer to follow your nose to explore Knowledge. RDFBrowser can help you on this task

RDFBrowser makes it easy to publish an inventory of resources you would like to show. Through the Admin panel go to the "Landing Page". You can define as many as you want RDF class types to show. You can also define the pagination limit.

Then for each class type, a new element is created on the landing page, hosted on your domain. 

Click on any of the types. RDFBrowser will show you all the instances belong to the requested class. 

In next update an autocomplete search bar will be added, and also pictures for classes, if available.

* Important: if you are updating the RDFBrowser, please run again ```php artisan migrate``` to include the latest database schema changes. 
