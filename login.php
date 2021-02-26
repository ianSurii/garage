<?php

require_once "classes/DbFunctions.php";

$execute= new dbFunction();
$username=$password="";
$username_err=$password_err="";

if(isset($_POST['login'])){
    extract($_POST);
    if(empty(trim($username))){
        $username_err= "Please enter username.";
    }else{
        $username=trim($username);
    }
    if(empty(trim($password))){
        $password_err="Please enter your password.";
    }else{
        $password=trim($password);
    }
    if(empty($username_err) && empty($password_err)){
        $encrypt_password=md5($password);
        $login=$execute->select('user_data',"Where username='$username' && password='$encrypt_password'");
        if($login==true){
            $usertype=$login[0]['user_type'];
            if($usertype==1){
                header('Location:services.php');
            }elseif($usertype==11){
                header('Location:mechanic.php');
            }elseif($usertype==111){
                header('Location:admin.php');
            }
        }else{
            echo "<script>window.alert('Try again')</script>";
        }
             
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
        <form action="" method="post">
        <div class="form-group<?php echo(!empty($username_err))? 'has-error': '';?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($password_err))? 'has-error': '';?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
            </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" name="login" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
        </div>
        </body>
        <html>