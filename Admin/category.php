<?php
   include('config.php');
   include('functions.php');
   checkUser();
   adminArea();
   
   if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
   	mysqli_query($conn,"delete from category where id=$id");
   	echo "<br/>Data deleted<br/>";
   }
   
   $res=mysqli_query($conn,"select * from category order by id desc");
   ?>
<?php
   if(mysqli_num_rows($res)>0){
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/expense.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  </head>
  <body>
  <?php
include("header.php");
?>
<script>
      navactive("dashboard");
    </script>
<div id="main">
        <div class="container">
               <h2>Category</h2>
               <div class="button">
                <button onclick="goto('manage_category.php');">Add Category</button>
            </div>
               <div class="table">
                  <table>
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th></th>
                        </tr>
                     <tbody>
                        <?php while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['name']?></td>
                           <td>
                              <a href="manage_category.php?id=<?php echo $row['id'];?>"><button class="btn edit">Edit</button></a>&nbsp;
                              <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','category.php')"><button class="btn delete">Delete</button></a>
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <?php } 
                     else{
                     	echo "No data found";
                     }
                     ?>
               </div>
            </div>
         </div>

<?php
   include('footer.php');
   ?>