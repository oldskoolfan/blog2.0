# blog2.0
rewrite of CSCI 2412 blog example

This is a basic example of how you can implement a blog site with the following functionality:

* Uploading images and saving to a database
* Admin privileges: only an admin can create/edit/delete blog posts
* Normal users can comment on blogs (can be deleted by admin)

## Setup Instructions

1. Clone or download the project to your htdocs directory
2. Make sure Apache and MySQL servers are running
3. Copy config.ini.example directly to htdocs (outside project) and rename as config.ini
4. Create a folder called `etc` somewhere on your file system
5. In config.ini, set `etc_directory` equal to the full path to the directory you created in step 4
6. In `etc`, create a file called `db-connect.php` with the following code:
	```
	<?php

	$con = new mysqli('localhost', 'root', '');
	```
7. Run the blogdb_xxx.sql file in Workbench
8. Go to the project index page in your browser
9. Create a user, then go into workbench and run the following:
	```
	update users set can_edit = true where id = 1;
	```
10. You can then create non-admin users after that.
