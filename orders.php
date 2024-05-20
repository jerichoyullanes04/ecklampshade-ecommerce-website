<?php
   include 'components/connect.php';

   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   };

   // Cancel Order Button Function
   if(isset($_POST['cancel'])) {
      echo '<script>alert("Order Cancelled")</script>';
      $order_id = $_POST['order_id'];
      $cancel_order_item = $conn->prepare("DELETE FROM `orders` WHERE id =?");
      $cancel_order_item->execute([$order_id]);
   }

      // Order Received Button Function
      if(isset($_POST['received'])) {
         echo '<script>alert("Order Completed")</script>';
         $order_id = $_POST['order_id'];
         $received_order_item = $conn->prepare("UPDATE `orders` SET payment_status = 'Completed'  WHERE id =?");
         $received_order_item->execute([$order_id]);
      }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <title>Orders</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
   </head>

   <style>

   </style>

   <body>
         
      <?php include 'components/user_header.php'; ?>

      <!-- PENDING -->
      <section class="orders" id="pendingDiv" >
         <h1 class="heading">placed orders</h1>

         <div class="order-nav">
            <button onclick="viewPending()">Pending</button>
            <button onclick="viewShip()">To Ship</button>
            <button onclick="viewReceive()">To Receive</button>
            <button onclick="viewCompleted()">Completed</button>
         </div>


         <div class="box-container">
            <?php
               if($user_id == ''){
                  echo '<div class="empty-container"><p class="empty">please login to see your orders</p></div>';
               }else{
                  $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'pending'");
                  $select_orders->execute([$user_id]);
                  if($select_orders->rowCount() > 0){
                     while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="box">
                           <form action="" method="post">
                              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                              <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                              <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                              <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                              <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                              <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                              <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                              <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                              <p>Total price : <span>₱<?= $fetch_orders['total_price']; ?></span></p>
                              <p>Order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>

                              <!-- Cancel Button -->
                              <?php if ($fetch_orders['payment_status'] == 'pending') { ?>
                                 <input type="submit" value="cancel order" onclick="return confirm('Are you sure you want to cancel this order?');" class="delete-btn" name="cancel">
                              <?php } ?>
                              
                              <!-- Received Button -->
                              <?php if ($fetch_orders['payment_status'] == 'To Receive') { ?>
                                 <input type="submit" value="order received" onclick="return confirm('Are you sure you received your order?');" class="btn" name="received">
                              <?php } ?>

                           </form>
                        </div>
                     <?php
                     }
                  }else{
                     echo '<p class="empty">No Pending Orders!</p>';
                  }
               }
            ?>
         </div>
      </section>

      <!-- TO SHIP -->
      <section style="display: none;" class="orders" id="shipDiv" >

         <h1 class="heading">placed orders</h1>

         <div class="order-nav">
            <button onclick="viewPending()">Pending</button>
            <button onclick="viewShip()">To Ship</button>
            <button onclick="viewReceive()">To Receive</button>
            <button onclick="viewCompleted()">Completed</button>
         </div>

         <div class="box-container">
            <?php
               if($user_id == ''){
                  echo '<div class="empty-container"><p class="empty">please login to see your orders</p></div>';
               }else{
                  $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'To Ship'");
                  $select_orders->execute([$user_id]);
                  if($select_orders->rowCount() > 0){
                     while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="box">
                           <form action="" method="post">
                              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                              <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                              <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                              <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                              <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                              <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                              <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                              <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                              <p>Total price : <span>₱<?= $fetch_orders['total_price']; ?></span></p>
                              <p>Order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>

                              <!-- Cancel Button -->
                              <?php if ($fetch_orders['payment_status'] == 'pending') { ?>
                                 <input type="submit" value="cancel order" onclick="return confirm('Are you sure you want to cancel this order?');" class="delete-btn" name="cancel">
                              <?php } ?>
                              
                              <!-- Received Button -->
                              <?php if ($fetch_orders['payment_status'] == 'To Receive') { ?>
                                 <input type="submit" value="order received" onclick="return confirm('Are you sure you received your order?');" class="btn" name="received">
                              <?php } ?>

                           </form>
                        </div>
                     <?php
                     }
                  }else{
                     echo '<p class="empty">No orders to ship!</p>';
                  }
               }
            ?>
         </div>
      </section>

      
      <!-- TO RECEIVE -->
      <section style="display: none;" class="orders" id="receiveDiv" >

         <h1 class="heading">placed orders</h1>

         <div class="order-nav">
            <button onclick="viewPending()">Pending</button>
            <button onclick="viewShip()">To Ship</button>
            <button onclick="viewReceive()">To Receive</button>
            <button onclick="viewCompleted()">Completed</button>
         </div>

         <div class="box-container">
            <?php
               if($user_id == ''){
                  echo '<div class="empty-container"><p class="empty">please login to see your orders</p></div>';
               }else{
                  $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'To Receive'");
                  $select_orders->execute([$user_id]);
                  if($select_orders->rowCount() > 0){
                     while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="box">
                           <form action="" method="post">
                              <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                              <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                              <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                              <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                              <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                              <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                              <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                              <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                              <p>Total price : <span>₱<?= $fetch_orders['total_price']; ?></span></p>
                              <p>Order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>

                              <!-- Cancel Button -->
                              <?php if ($fetch_orders['payment_status'] == 'pending') { ?>
                                 <input type="submit" value="cancel order" onclick="return confirm('Are you sure you want to cancel this order?');" class="delete-btn" name="cancel">
                              <?php } ?>
                              
                              <!-- Received Button -->
                              <?php if ($fetch_orders['payment_status'] == 'To Receive') { ?>
                                 <input type="submit" value="order received" onclick="return confirm('Are you sure you received your order?');" class="btn" name="received">
                              <?php } ?>
                           </form>
                        </div>
                     <?php
                     }
                  }else{
                     echo '<p class="empty">No orders to receive!</p>';
                  }
               }
            ?>
         </div>
      </section>

         <!-- Completed -->
         <section style="display: none;" class="orders" id="completedDiv" >

                     <h1 class="heading">placed orders</h1>
            
                     <div class="order-nav">
                        <button onclick="viewPending()">Pending</button>
                        <button onclick="viewShip()">To Ship</button>
                        <button onclick="viewReceive()">To Receive</button>
                        <button onclick="viewCompleted()">Completed</button>
                     </div>
            
                     <div class="box-container">
                        <?php
                           if($user_id == ''){
                              echo '<div class="empty-container"><p class="empty">please login to see your orders</p></div>';
                           }else{
                              $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'Completed'");
                              $select_orders->execute([$user_id]);
                              if($select_orders->rowCount() > 0){
                                 while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <div class="box">
                                       <form action="" method="post">
                                          <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                          <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                                          <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                                          <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                                          <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                                          <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                                          <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                                          <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                                          <p>Total price : <span>₱<?= $fetch_orders['total_price']; ?></span></p>
                                          <p>Order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
            
                                          <!-- Cancel Button -->
                                          <?php if ($fetch_orders['payment_status'] == 'pending') { ?>
                                             <input type="submit" value="cancel order" onclick="return confirm('Are you sure you want to cancel this order?');" class="delete-btn" name="cancel">
                                          <?php } ?>
                                          
                                          <!-- Received Button -->
                                          <?php if ($fetch_orders['payment_status'] == 'To Receive') { ?>
                                             <input type="submit" value="order received" onclick="return confirm('Are you sure you received your order?');" class="btn" name="received">
                                          <?php } ?>
                                       </form>
                                    </div>
                                 <?php
                                 }
                              }else{
                                 echo '<p class="empty">No completed orders!</p>';
                              }
                           }
                        ?>
                     </div>
                  </section>

      <?php include 'components/footer.php'; ?>
      
      <script src="js/orders.js"></script>
      <script src="js/script.js"></script>

   </body>
</html>