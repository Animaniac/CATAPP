<?php # CONNECT TO MySQL DATABASE.

DEFINE ('DB_USER', 'CATAPP');
DEFINE ('DB_PASSWORD', 'CATAPP2015');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'CATAPP_db');

# Connect  on 'localhost' for user 'mike' with password 'easysteps' to database 'site_db'.
$dbcon = @mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )

# Otherwise fail gracefully and explain the error. 
OR die ( mysqli_connect_error() ) ;
# Set encoding to match PHP script encoding.
mysqli_set_charset( $dbcon, 'utf8' ) ;
?>