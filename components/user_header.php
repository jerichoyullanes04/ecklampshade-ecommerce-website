<html>
   <head>
      <!-- Font Awesome CDN Link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <head>
</html>

<?php
   // Function na itatago yung login at register button kapag may naka logged in na user
   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
      
      ?> 
         <style>
            #login, #register { 
               display: none;
            }
         </style>
      <?php

   }else{ // kapag naka logged out naman itatago yung counts or quantity nung wishlist at cart
      ?>
         <style type="text/css"> 
            #counts {
               display:none;
            } 
         </style>

      <?php
   }

   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>



<header class="header">

   <section class="flex">

      
        <!--<a href="index.php" class="logo"><img class="logo-img" width="32px" height="32px" src='../images/icons/lamp64.png' alt=""> Online Lamp Store</a>-->
      
    <a href="index.php" class="logo"><img class="logo-img" width="58px" height="58px" src='../images/icons/eck-lampshade-logo.png' alt="ECK Lampshade Logo"> ECK Lampshade </a>

      <nav class="navbar">
         <a href="index.php">Home</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <!--<a href="contact.php">Message</a>-->
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         
         <a href="search_page.php" class="search-link"><i class="fas fa-search"></i></a>
         <a href="wishlist.php" class="wishlist-link" >
            <i class="fas fa-heart"></i>
            <span class="wishlist-counts" id="counts" >
               <?= $total_wishlist_counts; ?>
            </span>
         </a>
         <a href="cart.php" class="cart-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-counts" id="counts">
               <?= $total_cart_counts; ?>
            </span>
         </a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   
      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn" id="register">register</a>
            <a href="user_login.php" class="option-btn" id="login">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>

</html>