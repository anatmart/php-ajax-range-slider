<?php
$host="localhost";
$user="root";
$password="your_password";
$db="your_db";
$mysqli = new mysqli($host,$user,$password,$db);
// check connection
if (mysqli_connect_errno())
{
echo "connection was not established. " . mysqli_connect_error();
exit();
}

/* change character set to utf8 */

$mysqli->set_charset("utf8");

?>
