<!doctype html>
<html>
<head><title>Registration Form</title></head>
<body>

<form name="register" method="post" action="register.php">

Name : <input type="text" name="name" id="name">
Phone Number : <input type="text" name="phone number" id="phone">
Address : <input type="text" name="address" id="address">
Email : <input type="text" name="email" id="email">
<input type="submit" name="submit" action="submit">

</body>
</html>

<?php

$con =mysqli_connect ("localhost", "root", "", "customerdb") or die 
(mysqli_connect_errno($con));

$name=$_POST ["name"];
$phone=$_POST ["phone"];
$address=$_POST ["address"];
$email=$_POST ["email"];

mysqli_query($con, "insert into customer (name, phone, address, email)
values ('$name', '$phone', '$address', '$email')")
or die (mysqli_error($con));

?>

<?php

$con =mysqli_connect ("localhost", "root", "", "ruwekopi") or die 
(mysqli_connect_errno($con));

$username=$_POST ["username"];
$phonenumber=$_POST ["phone number"];
$password=$_POST ["password"];
$confirmpassword=$_POST ["confirm password"];

mysqli_query($con, "insert into customer (name, phone, address, email)
values ('$name', '$phone', '$address', '$email')")
or die (mysqli_error($con));

?>

