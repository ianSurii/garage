<?php
$conn=mysqli_connect("localhost","root","","newstuff");
if($conn)
{
$username=$_POST['username'];
$email=$_POST['email'];
$password=md5($_POST['password']);

$q="insert into customer(username,email,password) VALUES('$username','$email','$password')";

$processq=mysqli_query($conn,$q);
if($processq)
{
    header("location: indexfile.php");
}
else
{
    echo "Query failed to add the user";
}

}
else{

    echo "Connection not created";
}



?>