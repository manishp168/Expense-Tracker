<?php

   include('php/config.php');
   include('php/functions.php');
   checkUser();
   userArea();

   
   if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
   	mysqli_query($conn,"delete from expense where id=$id");
   	echo "<br/>Data deleted<br/>";
   }
   
   $res=mysqli_query($conn,"select expense.*,category.name from expense,category  where expense.category_id=category.id and expense.added_by='".$_SESSION['UID']."'
   order by expense.expense_date asc");
   ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/expense.css" />
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
            <h2>Expense</h2>
            <div class="button">
                <button onclick="addexpense()">Add Expenses</button>
            </div>
            <div class="table">
            <?php
    if(mysqli_num_rows($res)<0){
      echo "No Data Found";
    }
      else {
      
   ?>
                  <table>
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Category</th>
                           <th>Item</th>
                           <th>Price</th>
                           <th>Expense Date</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </tr>
                     <tbody>
                        <?php while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['name']?></td>
                           <td><?php echo $row['item']?></td>
                           <td><?php echo $row['price']?></td>
                           <td><?php echo $row['expense_date']?></td>
                           <td>
                              <a href="manage_expense.php?id=<?php echo $row['id'];?>"><button class="btn edit">Edit</button></a> </td>
                              <td>
                              <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','expense.php')"><button class="btn delete">Delete</button></a>

                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <?php 
                    
                     }
                     ?>
               </div>
        </div>
    </div>
    <?php
    include("php/footer.php");
    ?>
<script>
    function addexpense() {
        window.location.href = "manage_expense.php";
    }
</script>