<?php
session_start();
$captcha_error = "";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

include_once './commons/db.php';
include_once './user/userDao.php';
include_once './role/role.php';
include_once './user/user.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $captcha;
    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }

    if(!$captcha){
        $captcha_error = "Please check the the captcha form.";
    } else {
        $user = new User();
        $user->setUsername(trim($_POST["username"]));
        $user->setPassword(trim($_POST["password"]));
        $userDao = new UserDao();
    
        $user = $userDao->find($user);
    
        if (null !== $user->getId()) {
            $_SESSION["loggedin"] = true;
            $_SESSION["session_userid"] = $user->getId();
            $_SESSION["session_username"] = $user->getUsername();
            $_SESSION["session_name"] = $user->getName();
            $_SESSION["session_role"] = $user->getRole();
    
            if($user->getRole() == 1) {
                header("location: user_list.php");
            } else if($user->getRole() == 2) {
                header("location: car_list.php");
            } else {
                header("location: index.php");
            }
            
        } else {
            echo 'not found';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include './includes/head.php'; ?>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>
<body>
    <?php include './includes/header.php'; ?>
    <br><br>
    <div class="container">
            <div class="row">
                
                <div class="col-md-6">
                    <img src="images/reg.jpg" class="img img-thumbnail"/>
                </div>
                <div class="col-md-6">
                        <form method="POST" action="CustomerRegister.php" required="">
                        <div class="form-group">
                            <label>Enter First Name </label>
                            <input type="text"  name="txtFrstName" class="form-control" required=""/>
                        </div>
                        <div class="form-group">
                            <label>Enter Last Name </label>
                            <input type="text"  name="txtLastName" class="form-control" required=""/>
                        </div>
                        <div class="form-group">
                            <label>Enter Email-Id </label>
                            <input type="Email"  name="txtEmail" class="form-control" required=""/>
                        </div>
                        <div class="form-group">
                            <label>Enter Contact  </label>
                            <input type="Number"  name="txtMob" class="form-control" required=""/>
                        </div>
                        <div class="form-group">
                            <label>Enter Password </label>
                            <input type="password"  name="txtPassword" class="form-control" required=""/>
                        </div>
                        <div class="form-group">
                            <input type="submit"  value="submit" class="btn btn-primary" name="txtsubmit"/>
                        </div>
                        </form>
                </div>
                        
                </div>
            </div>
        </div>

</body>

</html>