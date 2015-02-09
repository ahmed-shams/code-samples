# Read & Initial System

R&I is a web application that is used to allow company administrators to track which documents have been read and signed by employees. Such documents can be required HR documents, technical policies and standard operation procedure documents, etc.

## Installation
- Upload files to your server
- Create Database for this app, I use 'rni', but you are free to use any other name
- Edit rni/includes/config.php with your connection and site details
- run the rni.sql file to load your database with initial data
- You should now be able to view the app in the browser


## Usage
- Click on the Register link on the top rght of the page and enter form fields
- Go to the [app-root]/admin in the browser to activate the registered user
- admin login, Username: admin, Password: admin
- From the admin panel, click on Member List from left navigation to view all current members
- Check the checkbox next to the user you wish to activate and then click on 'Activate' button
- You can now go to the app root in the browser and login as that user to view assigned documents and 
- 

### Demo
- User site: http://hoomashams.com/rni/
- Admin Panel: http://hoomashams.com/rni/admin 
- admin login: admin/admin
