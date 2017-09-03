# BlogCrunch

An implementation of a blog site. 

Features:
* Allow admins to add/edit blog posts
* Search posts by title
* Filter posts by author
* Register new accounts
* Leave comments on posts (for registered users and admins)

Coursework for year 2 "Databases, Networks and the Web".

## Deployment
1. Run the [createdb.sql](createdb.sql) on your SQL database (or manually recreate it).
2. Update the database details in [includes/database-connect.php](includes/database-connect.php)
3. Upload to a server with PHP (tested on PHP 5.4, but should work with any 5+)
