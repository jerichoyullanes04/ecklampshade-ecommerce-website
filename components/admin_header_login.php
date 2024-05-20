<?php
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
      <a href="../admin/dashboard.php" class="logo"><img class="logo" width="32px" height="32px" src="/edjong-final/images/icons/lamp64.png" alt=""> Online Lamp Store <span> Admin Panel</span></a>
   </section>

</header>