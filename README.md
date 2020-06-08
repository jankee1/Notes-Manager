# Notes-Manager
Main goal of this project was to create application that allows me to practice SQL along with PHP programming skills. Except from making my first fully working application with usage of these two languages my intention was also to make this code understandable and easy to maintain, hence I tried to implement MVC design pattern

## Please note, that:
1. This project is not finished yet -> it lacks of front-end layer.
2. This project lacks of '.htaccess' files which are crucial for launching this application (unfortunatlly GitHub doesn't allow such files to be uploaded), hence what should be done after downloading is written below.

## After downloading:
1. Make sure that 'notes_manager' is copied directly to 'htdocs' folder.
2. Import 'notes_manager.sql' file in phpMyAdmin panel (this file contains all necessary tables and columns which are required for this application to work properly).
3. Go to:
- notes_manager\app and create '.htacces' file. Inside this file type as follows: <br />
  Options -Indexes
- notes_manager\public and create '.htacces'file. Inside this file type as follows: <br />
  Options -MultiViews <br />
  RewriteEngine On <br />
  RewriteBase /notes_manager/public <br />
  RewriteCond %{REQUEST_FILENAME} !-d <br />
  RewriteCond %{REQUEST_FILENAME} !-f <br />
  RewriteRule  ^(.+)$ index.php?url=$1 [QSA,L] <br />
3. You can create your own account or use test account that is already created (login: 'test123', password: '123').
4. All data necessery for connection to database are included in 'config.php' file.

### Topics covered:
-	OOP
-	MVC
-	CRUD
-	Login and registration forms
-	Sessions
-	PDO

### Technologies used:
* HTML 5
* PHP 7.4.3
* SQL
