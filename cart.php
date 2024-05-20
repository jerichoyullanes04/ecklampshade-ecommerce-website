<?php
   // ininclude ko yung connect.php para sa database connection
   include 'components/connect.php'; // include function ipinapatong mo contents ng isang page sa isa pang page 

   session_start(); // itong function na toh magcecreate ng session ginagamit para sa pagkuha ng session variables 

   // Function na kapag hindi naka logged in as user ireredirect sa "User Login Page"
   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
      header('location:user_login.php');
   };

   // Delete Button Function
   if(isset($_POST['delete'])){
      $cart_id = $_POST['cart_id'];
      $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $delete_cart_item->execute([$cart_id]);
   }

   // Delete All Button Function
   if(isset($_GET['delete_all'])){
      $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart_item->execute([$user_id]);
      header('location:cart.php');
   }

   // Update Quantity Button Function
   if(isset($_POST['update_qty'])){
      $cart_id = $_POST['cart_id'];
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);
      $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
      $update_qty->execute([$qty, $cart_id]);
      $message[] = 'cart quantity updated';
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <title>Shopping Cart</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <?php include 'components/user_header.php'; // ipinapatong yung header or navigation bar sa taas 'include' function is parang itinatagpi mo yung isang page papunta sa isa pang page ?>

      <section class="products shopping-cart">
         <h3 class="heading">shopping cart</h3>
         <div class="box-container">
         <?php
            $grand_total = 0; // variable for grand total
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?"); // variable for sql command/query
            $select_cart->execute([$user_id]); // used the sql command/query to user id variable

            if($select_cart->rowCount() > 0){ // hanggat may maseselect siya sa rows dun sa database patuloy niyang iseselect pag wala irurun niya yung statement sa else
               while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ // magrereturn siya ng value na mula sa loob ng database tapos iistore niya sa variable na '$fetch_cart' hanggat meron paulit ulit tapos ididisplay niya yung data 

            // yung mga <?= $fetch_cart['id']; ididisplay yung value ng variable based dun sa parameter na nakalagay 
            // ...like halimbawa yung column name na 'id' yung value niyan ang madidisplay    
         ?>

         <form action="" method="post" class="box">
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
            <div class="name"><?= $fetch_cart['name']; ?></div>
            <div class="flex">
               <div class="price">₱<?= $fetch_cart['price']; ?></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
               <button type="submit" class="fas fa-edit" name="update_qty"></button>
            </div>
            <div class="sub-total"> sub total : <span>₱<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
            <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
         </form>
         <?php
         $grand_total += $sub_total; // iadd yung value ng subtotals then yun yung magiging value ng grand total  
            }
         }else{
            echo '<p class="empty">your cart is empty</p>'; 
         }
         ?>
         </div>

         <div class="cart-total">
            <p>grand total : <span>₱<?= $grand_total; ?></span></p>
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
            <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
         </div>

      </section>

      <?php include 'components/footer.php'; // para mailagay yung footer sa ilalim ?> 

      <script src="js/script.js"> //ito naman para ilagay dito yung functions mula dun sa script.js para sa navbar</script> 

   </body>
</html>