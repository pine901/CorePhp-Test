<?php
//Mysql connect with phptest database
$link = mysqli_connect("127.0.0.1", "root", "", "phptesting");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Print host information
echo "Database connected successfully. Host info: " . mysqli_get_host_info($link);

$address1 = $_REQUEST["address1"];
$address2 = $_REQUEST["address2"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zipcode = $_REQUEST["zipcode"];

var_dump($address1.$address2.$city.$state.$zipcode);

// Attempt insert query execution
$sql = "INSERT INTO address (address1, address2, city, state , zipcode) VALUES ('$address1','$address2','$city','$state','$address1')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>