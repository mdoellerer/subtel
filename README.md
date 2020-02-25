# SUBTEL
Test for developer job

- Installation



# INSTALLATION

## Requirements

Composer, PHP are the only requirements, for the dev environment I added phpunit but there is no tests at the moment so is not necessary

## Starting up

Git clone or unzip the package in a directory of your choice, then go to the directory of the composer.json file so you can run composer update, that will download the dependencies and create the composer autoload. Here we might want to exclude the dev packages, so I recommend composer install --no-dev

## The Command Line

I created this solution to run through php command line, after cloned on git and after composer update, to start the solution you can simply go to
the repository root, which is the same directory that contains composer.json or this README file and then run the bootstrap file like the example:

    php bootstrap.php UE8U2-SDS9CC-89DSCHNS-DDDD

the parameter after boostrap.php is the GUID of a Customer that one needs to query. You can also try without the parameter because I left my test case
as a default GUID so it will run without GUID also, but that is only because is a DEMO solution, of course.


