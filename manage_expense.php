<?php
    include('php/config.php');
    include('php/functions.php');
   checkUser();
   userArea();
   $msg="";
   $category_id="";
   $item="";
   $price="";
   $details="";
   $expense_date=date('Y-m-d');
   $label="Add";
   if(isset($_GET['id']) && $_GET['id']>0){
   	$label="Edit";
   	$id=get_safe_value($_GET['id']);
   	$res=mysqli_query($conn,"select * from expense where id=$id");
   	if(mysqli_num_rows($res)==0){
   		redirect('expense.php');
   		die();
   	}
   	$row=mysqli_fetch_assoc($res);
   	$category_id=$row['category_id'];
   	$item=$row['item'];
   	$price=$row['price'];
   	$details=$row['details'];
   	$expense_date=$row['expense_date'];
   	if($row['added_by']!=$_SESSION['UID']){
   		redirect('expense.php');
   	}
   	
   }
   
   if(isset($_POST['submit'])){
   	$category_id=get_safe_value($_POST['category_id']);
   	$item=get_safe_value($_POST['item']);
   	$price=get_safe_value($_POST['price']);
   	$details=get_safe_value($_POST['details']);
   	$expense_date=get_safe_value($_POST['expense_date']);
   	$added_on=date('Y-m-d h:i:s');
   	
   	$type="add";
   	$sub_sql="";
   	if(isset($_GET['id']) && $_GET['id']>0){
   		$type="edit";
   		$sub_sql="and id!=$id";
   	}
   	
   	$added_by=$_SESSION['UID'];
   	$sql="insert into expense(category_id,item,price,details,added_on,expense_date,added_by) values('$category_id','$item','$price','$details','$added_on','$expense_date','$added_by')";
   
      
   	if(isset($_GET['id']) && $_GET['id']>0){
   		$sql="update expense set category_id='$category_id',item='$item',price='$price',details='$details',expense_date='$expense_date' where id=$id";
   	}
   	mysqli_query($conn,$sql);
   	redirect('expense.php');
   }
   ?>
   <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/add-expense.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  </head>
  <body>
  <?php
include('php/header.php');
?>
<script>
      navactive("expense");
    </script>

<div id="main">
        <div class="container">
         <div class="form">
            <h4><?php echo $label; ?> Expense</h4>
            <div class="form">
              <div id="response">
              
              </div>
                     <form method="post">
                     <div class="input-box">
                  <div class="input-icon">
                    <i class="fa-solid fa-layer-group"></i>
                  </div>
                           <?php echo getCategory($category_id);
                              ?>                               
                        </div>

                        <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-hashtag"></i>
              </div>
                           <input type="text" name="item" required value="<?php echo $item?>" class="input" placeholder="Item" rquired>
                        </div>
                        <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-indian-rupee"></i>
              </div>
                           <input type="text" name="price" required value="<?php echo $price?>" class="input" placeholder="Enter Price" rquired>
                        </div>
                        <div class="input-box">
              <div class="input-icon">
                <i class="fa-solid fa-pen-to-square"></i>
              </div>
                           <input type="text" name="details" required value="<?php echo $details?>" class="input" placeholder="Enter Details" rquired>
                        </div>
                        <div class="input-box">
              <div class="input-icon">
              <i class="fa-solid fa-calendar-days"></i>
              </div>
                           <input type="date" name="expense_date" required value="<?php echo $expense_date?>" class="input" rquired max="<?php echo date('Y-m-d')?>">
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