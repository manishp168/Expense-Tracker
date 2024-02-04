<?php
   include('php/config.php');
   include('php/functions.php');
   checkUser();
   userArea();

   
   $cat_id='';
   $sub_sql='';
   $from='';
   $to='';
   if(isset($_GET['category_id']) && $_GET['category_id']>0){
   	$cat_id=get_safe_value($_GET['category_id']);
   	$sub_sql=" and category.id=$cat_id ";
   }
   
   if(isset($_GET['from'])){
   	$from=get_safe_value($_GET['from']);
   }
   if(isset($_GET['to'])){
   	$to=get_safe_value($_GET['to']);
   }
   
   if($from!=='' && $to!=''){
   	$sub_sql.=" and expense.expense_date between '$from' and '$to' ";
   }
   	
   
   $res=mysqli_query($conn,"select sum(expense.price) as price,category.name from expense,category where expense.category_id=category.id and expense.added_by='".$_SESSION['UID']."' $sub_sql  group by expense.category_id");
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Dashboard</title>
   <link rel="stylesheet" href="style/main.css">
   <link rel="stylesheet" href="style/reports.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>

   <?php
include('php/header.php');
?>
   <script>
      navactive("reports");
   </script>

   <div id="main">
      <div class="section">
      <div class="container">
      <div class="form">
         <form action="" method="get">
            <div class="input-field">
               <div class="input-here">
                  <span>From</span>
                  <input type="date" name="from" class="input" value="<?php echo $from?>"
                     max="<?php echo date('Y-m-d')?>" onchange="set_to_date()" id="from_date">
               </div>
               <div class="input-here">
                  <span>To</span>
                   <input type="date" class="input" name="to" value="<?php echo $to?>"
                     max="<?php echo date('Y-m-d')?>" id="to_date">
               </div>
            </div>
            <div class="select">
               <span>Category</span>
               <?php echo getCategory($cat_id,'reports');?>
            </div>
            <div class="select">
               <input type="submit" name="submit" value="Submit" class="submit">
            </div>
            
         </form>
      </div>
      </div>
      <?php
                  if(mysqli_num_rows($res)>0){
                  ?>
      <br /><br />
      <div class="table">
         <table>
            <thead>
            <tr>
               <th>Category</th>
               <th>Price</th>
            </tr>
         </thead>
            <tbody>
               <?php 
                           $final_price=0;
                           while($row=mysqli_fetch_assoc($res)){
                           $final_price=$final_price+$row['price'];	
                           ?>
               <tr>
                  <td>
                     <?php echo $row['name']?>
                  </td>
                  <td>
                     <?php echo $row['price']?>
                  </td>
               </tr>
               <?php } ?>
               <tr>
                  <th class="removebg">Total</th>
                  <th>
                     <?php echo $final_price?>
                  </th>
               </tr>
            </tbody>
         </table>
      </div>
      <?php } else {
                  echo "<b>No data found</b>";
                  }
                  ?>
   </div>
   </div>

   <?php
   include('footer.php');
   ?>