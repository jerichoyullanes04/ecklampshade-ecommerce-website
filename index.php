<?php
   // ininclude ko yung connect.php para sa database connection
   include 'components/connect.php'; // include function ipinapatong mo contents ng isang page sa isa pang page 

   session_start(); // itong function na toh magcecreate ng session ginagamit para sa pagkuha ng session variables 

   // Function na kapag hindi naka logged in as user ireredirect sa "User Login Page"
   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   }

   include 'components/wishlist_cart.php'; // import functions ng cart at wishlist
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="google-site-verification" content="uDL85v5-HWK4gL0Q5wyOlHt-IYi5APqzrq0piSUMnyQ" />
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png">
      <title>Home</title>

      <!-- Swiper CSS Link -->
      <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

      <!-- Custom CSS File Link  -->
      <link rel="stylesheet" href="css/style.css">

   </head>
   <body>
      
   <!-- include header file -->
   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">
      <section class="home">

         <!-- CSS Carousel na gawa sa Swiper para idisplay yung banner ng products  -->
         <div class="swiper home-slider">
         
            <div class="swiper-wrapper">

               <!-- Banner 1 -->
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/banners/banner-1.png" alt="">
                  </div>
                  <a style="border-radius:30px;" href="shop.php" class="btn">shop now</a>
               </div>
               <!-- Banner 2 -->
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/banners/banner-2.png" alt="">
                  </div>
                  <a style="border-radius:30px;" href="shop.php" class="btn">shop now</a>
               </div>
               <!-- Banner 3 -->
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/banners/banner-3.png" alt="">
                  </div>
                  <a style="border-radius:30px;" href="shop.php" class="btn">shop now</a>
               </div>

            </div>

               <div class="swiper-pagination"></div>

         </div>

      </section>
   </div>

   <section class="home-products">

      <h1 class="heading">latest products</h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php 
               $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); // sql command para kunin yung data sa products table sa database 
               $select_products->execute(); // tapos ito para iexecute na yung sql command para irun na
               if($select_products->rowCount() > 0){ // iseselect niya lahat ng data na nasa loob ng products tapos ididisplay
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){  // magrereturn siya ng value na mula sa loob ng database tapos iistore niya sa variable na '$fetch_product' hanggat meron paulit ulit tapos ididisplay niya yung data sa forms 
               
               // yung mga <?= $fetch_product['id']; ididisplay yung value ng variable based dun sa parameter na nakalagay 
               // ...like halimbawa yung column name na 'name' sa loob ng product table sa database yung value na yun ang madidisplay  
            ?>
            
            <form action="" method="post" class="swiper-slide slide">
               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
               <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
               <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <div class="name"><?= $fetch_product['name']; ?></div>
               <div class="flex">
                  <div class="price"><span>₱</span><?= $fetch_product['price']; ?></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
               </div>
               <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            </form>
            <?php
               }
            }else{
               echo '<p class="empty">no products added yet!</p>'; // pag walang laman yung products table na value ito yung irurun na statement
            }
            ?>

         </div>

         <div class="swiper-pagination"></div> <!-- ito yung built in pagination ng swiper -->

      </div>

   </section>

   <!-- include footer -->
   <?php include 'components/footer.php'; ?>

   <!-- Custom javascript -->
   <script src="js/script.js"></script>

   <!-- Swiper javascript link -->
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   
   <!-- Swiper custom javascript para dun sa products na nakadisplay sa ilalim ito yung custom functions niya -->
   <script>
      var swiper = new Swiper(".home-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop:true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
         breakpoints: {
            550: {
            slidesPerView: 2,
            },
            768: {
            slidesPerView: 2,
            },
            1024: {
            slidesPerView: 3,
            },
         },
      });
   </script>

   </body>
</html>