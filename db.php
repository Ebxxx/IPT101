<?php

$sname= "localhost: 3307";
$uname="root";
$password ="";
$db_name = "ipt101";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

echo  "<div style='text-align:center;'><h3>Connection success</h3></div>";

if (!$conn){

    echo "Failed to connect";
}
?>  