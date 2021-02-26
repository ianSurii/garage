<?php
require_once "config.php";

$fname=$lname=$idnumber=$residence=$username=$password=$confirm_password="";
$fname_err=$lname_err=$idnumber_err=$residence_err=$username_err=$password_err=$confirm_password_err="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["fname"]))){
        $fname_err="Please enter your firstname";
    }else{
        $sql="SELECT fname FROM users WHERE fname=?";
        if($stmt=mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_fname);
            $param_fname=trim($_POST["fname"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }else{
                $fname=trim($_POST["fname"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["lname"]))){
        $fname_err="Please enter your lastname";
    }else{
        $sql="SELECT lname FROM users WHERE lname=?";
        if($stmt=mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_lname);
            $param_lname=trim($_POST["lname"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }else{
                $lname=trim($_POST["lname"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["idnumber"]))){
        $idnumber_err="Please enter your idnumber";

    }elseif(strlen(trim($_POST["idnumber"]))<8){
        $idnumber_err="Must have at least eight characters.";
    }else{
        $idnumber=trim($_POST["idnumber"]);
    }
            mysqli_stmt_close($stmt);
    
    if(empty(trim($_POST["Residence"]))){
        $residence_err="Please enter your location";
    }else{
        $sql="SELECT residence FROM users WHERE residence=?";
        if($stmt=mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_residence);
            $param_residence=trim($_POST["residence"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }else{
                $residence=trim($_POST["residence"]);
            }
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["username"]))){
        $username_err="Please enter a username";
    }else{
        $sql="SELECT id FROM users WHERE username=?";
        if($stmt=mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            $param_username=trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)==1){
                $username_err="This username is already taken";
            }else{
                $username=trim($_POST["username"]);
            }
            }else{
                echo"Oops!Something went wrong.Try again";
            }
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["password"]))){
        $password_err="Please enter a password";

    }elseif(strlen(trim($_POST["password"]))<6){
        $password_err="Password must have at least six characters.";
    }else{
        $password=trim($_POST["password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err="Please confirm password";
    }else{
        $confirm_password=trim($_POST["confirm_password"]);
        if(empty($password_err)&&($password !=$confirm_password)){
            $confirm_password_err="Password does not match.";
        }
    }
    if(empty($fname_err)&& empty($lname_err)&& empty($idnumber_err)&& empty($residence_err)&& empty($username_err)&& empty($password_err)&& empty($confirm_password_err)){
        $sql="INSERT INTO users(fname, lname, idnumber, residence, username, password)
        VALUES(?,?)";
        if($stmt=mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ss",$param_fname,$param_lname,$param_idnumber,$param_residence,$param_username,$param_password);

            
            $param_fname=$fname;
            $param_lname=$lname;
            $param_idnumber=$idnumber;
            $param_residence=$residence;
            $param_username=$username;
            $param_password= password_hash($password,PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            }else{
                echo"Something went wrong.Try again.";
            }mysqli_stmt_close($stmt);
        }    

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
        <div class="form-group<?php echo(!empty($fname_err))? 'has-error': '';?>">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            <span class="help-block"><?php echo $fname_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($lname_err))? 'has-error': '';?>">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
            <span class="help-block"><?php echo $lname_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($residence_err))? 'has-error': '';?>">
            <label>Residence</label>
            <input type="text" name="residence" class="form-control" value="<?php echo $residence; ?>">
            <span class="help-block"><?php echo $residence_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($idnumber_err))? 'has-error': '';?>">
            <label>National ID</label>
            <input type="text" name="idnumber" class="form-control" value="<?php echo $idnumber; ?>">
            <span class="help-block"><?php echo $idnumber_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($username_err))? 'has-error': '';?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
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
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>
        <a href="mechanics.php" class="btn btn-warning">Join our team</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
        <p>Already have an account?<a href="login.php">Login here</a>.</p>
        </form>
        </div>
        </body>
        <html>

