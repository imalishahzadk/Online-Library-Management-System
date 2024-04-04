<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{

$fname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username']; 
$password = md5($_POST['password']); 
$status = 1;

// Check if there are any existing admin records
$sql_check_admin = "SELECT COUNT(*) AS admin_count FROM admin";
$query_check_admin = $dbh->prepare($sql_check_admin);
$query_check_admin->execute();
$row = $query_check_admin->fetch(PDO::FETCH_ASSOC);
$admin_count = $row['admin_count'];

if ($admin_count > 0) {
    // If an admin already exists, prevent registration and display message
    echo '<script>alert("An admin already exists. You cannot register as admin.");</script>';
} else {
    // If no admin exists, proceed with registration
    $sql = "INSERT INTO admin (FullName, AdminEmail, UserName, Password) VALUES (:fname, :email, :username, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    if ($query->execute()) {
        echo '<script>alert("Your registration was successful.");</script>';
    } else {
        echo '<script>alert("Something went wrong. Please try again.");</script>';
    }
}
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BookNest</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line" style="text-align: center;">ADMIN REGISTRATION FORM</h4>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 Registration Form
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullname" autocomplete="off" required />
</div>
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" autocomplete="off" required />
</div>
<div class="form-group">
<label>Enter Username</label>
<input class="form-control" type="text" name="username" autocomplete="off" required />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required />
</div>

 <button type="submit" name="signup" class="btn btn-info">Register </button>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</script>
</body>
</html>
