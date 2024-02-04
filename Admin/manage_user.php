<?php
include('config.php');
include('functions.php');
checkUser();
adminArea();
$msg="";
$username="";
$password="";
$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
	$label="Edit";
	$id=get_safe_value($_GET['id']);
	$res=mysqli_query($conn,"select * from users where id=$id");
	if(mysqli_num_rows($res)==0){
		redirect('users.php');
		die();
	}
	$row=mysqli_fetch_assoc($res);
	$username=$row['username'];
	$password=$row['password'];
}

if(isset($_POST['submit'])){
	$username=get_safe_value($_POST['username']);
	$password=get_safe_value($_POST['password']);
	$type="add";
	$sub_sql="";
	if(isset($_GET['id']) && $_GET['id']>0){
		$type="edit";
		$sub_sql="and id!=$id";
	}
	
	$res=mysqli_query($conn,"select * from users where username='$username' $sub_sql");
	if(mysqli_num_rows($res)>0){
		$msg="Username already exists";
	}else{
		
		$password=password_hash($password,PASSWORD_DEFAULT);
		
		$sql="insert into users(username,password,role) values('$username','$password','User')";
		if(isset($_GET['id']) && $_GET['id']>0){
			$sql="update users set username='$username',password='$password' where id=$id";
		}
		mysqli_query($conn,$sql);
		redirect('users.php');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/admin.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  </head>
  <body>
  <?php
include("header.php");
?>
<script>
      navactive("expense");
    </script>

<div id="main">
        <div class="container">

<div class="form">
		 <h2><?php echo $label?> Users</h2>
		 <?php if(isset($msg) && $msg != ''){
		     echo '<div id="toast-msg" style="height: 52px;background: #393996;color: white;border-radius: 5px;text-align: center;display: flex;align-items: center;justify-content: center;">'.$msg.'</div>';
		    
		 }
		 ?>

<form method="post">

<span>Username</span>
            <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-user"></i>
              </div>
                           <input type="text" name="username" required value="<?php echo $username?>" class="input" placeholder="Username" rquired>
                        </div>
						<br>
<span>Password</span>
            <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-lock"></i>
              </div>
                           <input type="password" name="password" required value="<?php echo $password?>" class="input" placeholder="Password" rquired>
                        </div>
	

						<div class="submit-btn">								
                           <input type="submit" name="submit" value="Submit"  class="submit">                          
                        </div>
                        
                        </form>
          </div>
        </div>
        </div>
    </div>
<?php
   include('footer.php');
   ?>