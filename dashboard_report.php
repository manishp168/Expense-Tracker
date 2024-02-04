<?php

   include('php/config.php');
   include('php/functions.php');

   checkUser();
   userArea();
  
   $from='';
   $to='';
   $sub_sql="";
   if(isset($_GET['from'])){
   	$from=get_safe_value($_GET['from']);
   }
   if(isset($_GET['to'])){
   	$to=get_safe_value($_GET['to']);
   }
   
   if($from!=='' && $to!=''){
   	$sub_sql.=" and expense.expense_date between '$from' and '$to' ";
   }
   
   
   $res=mysqli_query($conn,"select expense.price,category.name,expense.item,expense.expense_date from expense,category where expense.category_id=category.id  and expense.added_by='".$_SESSION['UID']."' $sub_sql");
   ?>
   <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reports</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/expense.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  </head>
  <body>
  <?php
include("php/header.php");
?>
<script>
      navactive("dashboard");
    </script>
<div id="main">
        <div class="container">
         <div>
                  <h2 class="font">
                     <?php if($from!='' && $to!=''){ ?>
                     From <?php echo $from?>
                     :
                     To <?php echo $to?>
                     <?php } ?>
                  </h2>
               
               </div>
               <?php
                  if(mysqli_num_rows($res)>0){
                  ?>
               <div class="table" style="margin-top: 40px;">
                  <table>
                     <thead>
                     <tr>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Expense Date</th>
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
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['item']?></td>
                        <td><?php echo $row['expense_date']?></td>
                        <td><?php echo $row['price']?></td>
                     </tr>
                     
                     <?php } ?>
                     <tr class="removebg">
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th><?php echo $final_price?></th>
                     </tr>
                        </tbody>
                  </table>
                  <?php } else {
                     echo "<b>No data found</b>";
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include('footer.php');
   ?>