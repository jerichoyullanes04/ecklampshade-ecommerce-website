<?php

   include 'components/connect.php';  

   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
      header('location:user_login.php');
   };

   // Order Button Function
   if(isset($_POST['order'])){

      // variable declarations based dun sa iinput ng user
      $name = $_POST['name']; // iistore yung user input sa variable na "$name"
      $name = filter_var($name, FILTER_SANITIZE_STRING); // removes tags at mga special characters sa value ng string variable
      $number = $_POST['number'];
      $number = filter_var($number, FILTER_SANITIZE_STRING);
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
      $method = $_POST['method'];
      $method = filter_var($method, FILTER_SANITIZE_STRING);
      $address = ''. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
      $address = filter_var($address, FILTER_SANITIZE_STRING);
      $total_products = $_POST['total_products'];
      $total_price = $_POST['total_price'];

      // iseselect yung value sa database na cart
      $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $check_cart->execute([$user_id]);

      // ichecheck kung may laman ba yung cart mo
      if($check_cart->rowCount() > 0){

         // kapag meron iinsert na from cart table to orders table yung data na nafetch dun sa cart mo sa loob ng database 
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         // then idedelete na yung data na nandun sa cart table sa loob ng database
         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         if($method == 'GCash') {
            header('location: /components/gcash_payment.php');
         } else {
            // magdisplay ng message kapag tapos na macheckout
            echo '<script>alert("Order Place Succesfully")</script>';
            echo "<script>setTimeout(\"location.href = 'orders.php';\",300);</script>";
         }
      }else{
         // kapag walang nadetect na laman yung cart ito yung idisplay na message
         $message[] = 'your cart is empty';
      }

   }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <title>Checkout</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">

      <style>
         /* Chrome, Safari, Edge, Opera */
         input::-webkit-outer-spin-button,
         input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
         }

         /* Firefox */
         input[type=number] {
            -moz-appearance: textfield;
         }
      </style>
   </head>
   <body>
      
      <?php include 'components/user_header.php'; ?>

      <section class="checkout-orders">

         <form action="" method="POST">

         <h3>your orders</h3>

            <div class="display-orders">
            <?php
               // variables
               $grand_total = 0; // para sa grandtotal
               $cart_items[] = ''; // array variable para sa laman ng cart
               $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?"); // sql commands/query kung saan iseselect lahat ng laman ng cart table sa database
               $select_cart->execute([$user_id]); // gagamitin yung sql command/query dun sa variable na nasa parameter 

               if($select_cart->rowCount() > 0){ // hanggat may laman yung cart kukunin niya yung data at ididisplay
                  while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                     $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                     $total_products = implode($cart_items);
                     $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
               <p> <?= $fetch_cart['name']; ?> <span>(<?= '₱'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
            <?php
                  }
               }else{
                  echo '<p class="empty">your cart is empty!</p>'; // kapag walang laman yung car ito yung ididisplay
               }
            ?>
               <input type="hidden" name="total_products" value="<?= $total_products; ?>">
               <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
               <div class="grand-total">Grand Total : <span>₱<?= $grand_total; ?></span></div>
            </div>

            <h3>place your orders</h3>

         <!-- Input Form sa Checkout -->
            <div class="flex">
               <div class="inputBox">
                  <span>Full Name :</span>
                  <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
               </div>
               <div class="inputBox">
                  <span>Contact Number :</span>
                  <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 11) return false;" required>
               </div>
               <div class="inputBox">
                  <span>Email :</span>
                  <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>Payment Method :</span>
                  <select name="method" class="box" required>
                     <option value="Cash on Delivery">Cash on Delivery</option>
                     <option value="GCash">GCash</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Address Line 01 :</span>
                  <input type="text" name="flat" placeholder="e.g. block and lot number" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>Address Line 02 :</span>
                  <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>City :</span>
                  <input type="text" name="city" placeholder="e.g. San Jose Del Monte City" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>Barangay :</span>
                  <input type="text" name="state" placeholder="e.g. Kaypian" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>Country :</span>
                  <input type="text" name="country" placeholder="e.g. Philippines" class="box" maxlength="50" required>
               </div>
               <div class="inputBox">
                  <span>Zip Code :</span>
                  <input type="number" min="0" name="pin_code" placeholder="e.g. 3023" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
               </div>
            </div>

            <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

         </form>

      </section>

      <?php include 'components/footer.php'; ?>

      <script src="js/script.js"></script>

   </body>
</html>