<?php
require_once "config.php";
include 'classes/DbFunctions.php';
$execute=new dbFunction();

$username_input=$password=$confirm_password=$usertype="";
$username_err=$password_err=$confirm_password_err="";
$user_type_err="";

if(isset($_POST['register'])){
    extract($_POST);
    if(empty(trim($username))){
        $username_err="Please enter a username";
    }else{
     $check_availability=$execute->select('user_data',"where username='$username'");

        
            if($check_availability==true){
               
           
                $username_err="This username is already taken";
            }else{
                $username_input=$username;
            
            
           
        }
    }
    // if(empty(trim($_POST['usertype']))){

    //     $user_type_err="Select one";
    // }else{
        
        
       
    // }
    if(empty(trim($password))){
        $password_err="Please enter a password";

    }elseif(strlen(trim($password))<6){
        $password_err="Password must have at least six characters.";
    }else{
        $password=trim($password);
    }
    if(empty(trim($confirm_password))){
        $confirm_password_err="Please confirm password";
    }else{
        $confirm_password=trim($confirm_password);
        if(empty($password_err)&&($password !=$confirm_password)){
            $confirm_password_err="Password does not match.";
        }
    }
    if(empty($username_err)&& empty($password_err)&& empty($confirm_password_err) && empty($usertype_err)){
        // extract($_POST);
        
        if($usertype=="Admin"){
            $usertype_value=111;

        }elseif($usertype=="Mechanic"){
            $usertype_value=11;

        }else{
            $usertype_value=1;
        }
        $table="user_data";
        $column="username,password,user_type";
        $encrypted_password=md5($password);
        $values="'$username','$encrypted_password','$usertype_value'";
        $register=$execute->insert($table,$column,$values);
        if($register==true){
            header('Location:login.php');
        }
        else{
            echo "<script>window.alert('Try again')</script>";
        }


        // $sql="INSERT INTO users(username, password)
        // VALUES(?,?)";
        // if($stmt=mysqli_prepare($link,$sql)){
        //     mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);

        //     $param_username=$username;
        //     $param_password= password_hash($password,PASSWORD_DEFAULT);

        //     if(mysqli_stmt_execute($stmt)){
        //         header("location: login.php");
        //     }else{
        //         echo"Something went wrong.Try again.";
        //     }mysqli_stmt_close($stmt);
        // }    

    }
    mysqli_close($link);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group<?php echo(!empty($username_err))? 'has-error': '';?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username_input; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group<?php echo(!empty($confirm_password_err))? 'has-error': '';?>">
            <label>Select User Type</label>
            <select type="password" name="usertype" class="form-control" value="<?php echo $usertype; ?>">
            <span class="help-block"><?php echo $usertype_err; ?></span>
            <option value="Admin" selected='selected'>Admin</option>
            <option value="Mechanic" selected='selected'>Mechanic</option>
            <option value="Client" selected='selected'>Client</option>
            </select>
            </div>
        <div class="form-group<?php echo(!empty($password_err))? 'has-error': '';?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">

            <span class="help-block"><?php echo $password_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($confirm_password_err))? 'has-error': '';?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" name="register" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account?<a href="login.php">Login here</a>.</p>
        </form>
        </div>
        </body>
        <html>

