<?php
  include('php/config.php');
  include('php/functions.php');
  checkUser();
  userArea();
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/index.css" />
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
   <main id="main">
      <div class="container">
        <div class="mainbox">
        <div class="box">
          <?php $calling = getDashboardExpense('today')?>
          <div class="forflex">
              <h3><?php echo $calling[0]; ?></h3>
              <?php echo $calling[1]; ?>
          </div>
          <p>Today's Expense</p>
        </div>
        </div>
        <div class="mainbox">
    <div class="box">
        <?php $calling = getDashboardExpense('yesterday')?>
        <div class="forflex">
            <h3><?php echo $calling[0]; ?></h3>
            <?php echo $calling[1]; ?>
        </div>
        <p>Yesterday's Expense</p>
    </div>
</div>

        <div class="mainbox">
        <div class="box">
         <?php $calling = getDashboardExpense('week')?>
         <div class="forflex">
             <h3><?php echo $calling[0]; ?></h3>
             <?php echo $calling[1]; ?>
         </div>
          <p>This Week Expense</p>
        </div>
        </div>
        <div class="mainbox">
        <div class="box">
         <?php $calling = getDashboardExpense('month')?>
         <div class="forflex">
             <h3><?php echo $calling[0]; ?></h3>
             <?php echo $calling[1]; ?>
         </div>
          <p>This Month Expense</p>
        </div>
        </div>
        
        <div class="mainbox">
        <div class="box">
         <?php $calling = getDashboardExpense('year')?>
         <div class="forflex">
             <h3><?php echo $calling[0]; ?></h3>
             <?php echo $calling[1]; ?>
         </div>
          <p>This Year Expense</p>
        </div>
      </div>
        </div>
    </main>
   
<?php
   include('footer.php');
   ?>