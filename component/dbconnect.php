<?php

$servername="localhost";
$username="root";
$password="";
$database="discuss";

$conn = mysqli_connect($servername, $username, $password, $database);

if($conn)
{
    echo"";

}
else{
     die("problem in connect with database" .  mysqli_connect_error());
}

?>