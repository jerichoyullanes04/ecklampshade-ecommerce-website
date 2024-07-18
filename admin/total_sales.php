<?php
session_start();
   include '../components/connect.php';


   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:admin_login.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sales History</title>
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>

      <?php include '../components/admin_header.php'; ?>

      <section class="orders">

         <h1 class="heading">Sales History</h1>

         <div class="box-container">

            <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'completed'");
               $select_orders->execute();
               if($select_orders->rowCount() > 0){
                  while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
                     <div class="box">
                        <p> Placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                        <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
                        <p> Contact Number : <span><?= $fetch_orders['number']; ?></span> </p>
                        <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
                        <p> Total Products : <span><?= $fetch_orders['total_products']; ?></span> </p>
                        <p> Total Price : <span>₱<?= $fetch_orders['total_price']; ?></span> </p>
                        <p> Payment Method : <span><?= $fetch_orders['method']; ?></span> </p>
                        <p> Order Status : <span><?= $fetch_orders['payment_status']; ?></span> </p>
                     </div>
            <?php
                  }
               }else{
                  echo '<p class="empty">no orders placed yet!</p>';
               }
            ?>
         </div>
      </section>

   </section>

   <script src="../js/admin_script.js"></script>
      
   </body>
</html>