<?php

session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] ===true){
    header("location:online.php");
    exit;
}
require_once "config.php";

$problem=$make=$model=$location="";
$problem_err=$make_err=$model_err=$location_err="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["problem"]))){
        $problem_err= "Please enter your vehicle problem.";
    }else{
        $problem=trim($_POST["problem"]);
    }
    if(empty(trim($_POST["make"]))){
        $make_err="Please enter the make of your vehicle.";
    }else{
        $make=trim($_POST["make"]);
    }
    if(empty(trim($_POST["model"]))){
        $model_err="Please enter the model of your vehicle.";
    }else{
        $model=trim($_POST["model"]);
    }
    if(empty(trim($_POST["location"]))){
        $location_err="Please state your current location.";
    }else{
        $location=trim($_POST["location"]);
    }
    if(empty($problem_err) && empty($problem_err)){
        $sql= "SELECT year, problem, make, model, location FROM users WHERE problem=?";
        if($stmt=mysqli_prepare($link, $sql)){
             mysqli_stmt_bind_param($stmt,"s",$param_problem);
             $param_problem=$problem;
             if(mysqli_stmt_execute($stmt)){
                 mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)==1){
                mysqli_stmt_bind_result($stmt, $year, $problem, $make, $model, $location);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        $SESSION["loggedin"]=true;
                        $SESSION["id"]= $id;
                        $SESSION["username"]= $username;

                    header("location:welcome.php");
                    }else{
                        $password_err="Invalid password";
                    }
                }
            }else{
                $username_err="Username does not exist.";
            }
             }else{
                 echo "Oops something went wrong.Try again later.";
             }
             mysqli_stmt_close($stmt);
    }
}
            mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Online Diagnosis</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Dont get stranded,contact us anywhere you are and a mechanic will come to assist you.</h1>
    </div> 
    <div class="wrapper">
    <h2>Online Diagnosis</h2>
    <p>Please fill this form to help us know your vehicle problem.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group<?php echo(!empty($problem_err))? 'has-error': '';?>">
            <label>Problem</label>
            <input type="text" name="Problem" class="form-control" value="<?php echo $problem; ?>">
            <span class="help-block"><?php echo $problem_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($make_err))? 'has-error': '';?>">
            <label>Make</label>
            <input type="make" name="make" class="form-control" value="<?php echo $make; ?>">
            <span class="help-block"><?php echo $make_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($model_err))? 'has-error': '';?>">
            <label>Model</label>
            <input type="model" name="model" class="form-control" value="<?php echo $model; ?>">
            <span class="help-block"><?php echo $model_err; ?></span>
            </div>
        <div class="form-group<?php echo(!empty($location_err))? 'has-error': '';?>">
            <label>Location</label>
            <input type="location" name="location" class="form-control" value="<?php echo $location; ?>">
            <span class="help-block"><?php echo $location_err; ?></span>
            </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        </div>
</body>
</html>
