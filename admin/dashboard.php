<?php
   include '../components/connect.php';

   session_start();
   $admin_id = $_SESSION['admin_id']; // iset yung admin_id value sa session

   if(!isset($admin_id)){ // kapag hindi nakaset yung session or in short kapag di nakalogged in as admin ireredirect sa adminlogin page
      header('location:admin_login.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Dashboard</title>
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>

      <?php include '../components/admin_header.php'; ?>

      <section class="dashboard">
         <h1 class="heading">Admin Dashboard</h1>
         <div class="box-container">

            <!-- Update Profile -->
            <div class="box">
               <h3>Welcome!</h3>
               <p><?= $fetch_profile['name']; ?></p>
               <a href="update_profile.php" class="btn">update profile</a>
            </div>

            <!-- Total Pending Sales -->
            <div class="box">
               <?php
                  $total_pendings = 0;
                  $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status != ?");
                  $select_pendings->execute(['Completed']);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
               ?>
               <h3><span>₱</span><?= $total_pendings; ?></h3>
               <p>Total Pending Sales</p>
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
            
            <!-- Total Sales Completed -->
            <div class="box">
               <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                  $select_completes->execute(['completed']);
                  if($select_completes->rowCount() > 0){
                     while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                        $total_completes += $fetch_completes['total_price'];
                     }
                  }
               ?>
               <h3><span>₱</span><?= $total_completes; ?></h3>
               <p>Total Sales Completed</p>
               <a href="total_sales.php" class="btn">View Sales History</a>
            </div>

            <!-- Orders Placed -->
            <div class="box">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status != 'Completed'");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount()
               ?>
               <h3><?= $number_of_orders; ?></h3>
               <p>orders placed</p>
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
            
            <!-- Products -->
            <div class="box">
               <?php
                  $select_products = $conn->prepare("SELECT * FROM `products`");
                  $select_products->execute();
                  $number_of_products = $select_products->rowCount()
               ?>
               <h3><?= $number_of_products; ?></h3>
               <p>products added</p>
               <a href="products.php" class="btn">see products</a>
            </div>
            
            <!-- User Accounts -->
            <div class="box">
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `users`");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount()
               ?>
               <h3><?= $number_of_users; ?></h3>
               <p>Users Accounts</p>
               <a href="users_accounts.php" class="btn">see users</a>
            </div>
            
            <!-- Admin Accounts -->
            <div class="box">
               <?php
                  $select_admins = $conn->prepare("SELECT * FROM `admins`");
                  $select_admins->execute();
                  $number_of_admins = $select_admins->rowCount()
               ?>
               <h3><?= $number_of_admins; ?></h3>
               <p>Admin Accounts</p>
               <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
            
            <!-- Messages -->
            <div class="box">
               <?php
                  $select_messages = $conn->prepare("SELECT * FROM `messages`");
                  $select_messages->execute();
                  $number_of_messages = $select_messages->rowCount()
               ?>
               <h3><?= $number_of_messages; ?></h3>
               <p>Messages</p>
               <a href="messages.php" class="btn">see messages</a>
            </div>
         </div>
      </section>
                  
      <script src="../js/admin_script.js">// script for admin header</script>
         
   </body>
</html>