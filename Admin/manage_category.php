<?php
include('config.php');
include('functions.php');
checkUser();
adminArea();
$msg="";
$category="";
$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
	$label="Edit";
	$id=get_safe_value($_GET['id']);
	$res=mysqli_query($conn,"select * from category where id=$id");
	if(mysqli_num_rows($res)==0){
		redirect('category.php');
		die();
	}
	$row=mysqli_fetch_assoc($res);
	$category=$row['name'];
}

if(isset($_POST['submit'])){
	$name=get_safe_value($_POST['name']);
	
	$type="add";
	$sub_sql="";
	if(isset($_GET['id']) && $_GET['id']>0){
		$type="edit";
		$sub_sql="and id!=$id";
	}
	
	$res=mysqli_query($conn,"select * from category where name='$name' $sub_sql");
	if(mysqli_num_rows($res)>0){
		$msg="Category already exists";
	}else{
		$sql="insert into category(name) values('$name')";
		if(isset($_GET['id']) && $_GET['id']>0){
			$sql="update category set name='$name' where id=$id";
		}
		mysqli_query($conn,$sql);
		redirect('category.php');
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
		 <h2><?php echo $label?> Expense</h2>

<form method="post">
<span>Category Name</span>
            <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-list"></i>
              </div>
                           <input type="text" name="name" required value="<?php echo $category?>" class="input" placeholder="Category Name" rquired>
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