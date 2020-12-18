# CRM in PHP Codeigniter

## Steps to deploy project on server-

1. Put all the project data into archive, upload it on server storage and extract it.
2. Copy the queries inside localhost.sql and run it on phpmyadmin
3. Change base_url in config/config.php (Must include full url name eg. http://crm.sachinartani.com)
4. Change database details in config/database.php such as hostname, username, password and database
5. Set localtime offset of user from config/constants.php, line 89 in defined constant LOCAL_TIME

## Common Helper (autoloaded)

A helper that contain all functions that are used in most of the controllers.
Functions defined inside common helper-
setOutput() - for rtnMsg and success
getprivileges() - for fetching user privileges for accessing modules
getUTC() - returns gmt data/time
getLocalTime() - returns localtime by accepting date as string and format

# To get all controllers with their methods use- $this->controllerlist->getControllers();
controllerlist is defined in application/libraries and updated to autoload.php
