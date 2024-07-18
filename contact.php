<?php
   include 'components/connect.php';

   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   };

   if(isset($_POST['send'])){

      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
      $number = $_POST['number'];
      $number = filter_var($number, FILTER_SANITIZE_STRING);
      $msg = $_POST['msg'];
      $msg = filter_var($msg, FILTER_SANITIZE_STRING);

      $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
      $select_message->execute([$name, $email, $number, $msg]);

      if($select_message->rowCount() > 0){
         $message[] = 'already sent message!';
      }else{

         $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
         $insert_message->execute([$user_id, $name, $email, $number, $msg]);

         $message[] = 'sent message successfully!';

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
      <title>Contact</title>
      
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

      <section class="contact">

         <form action="" method="post">
            <h3>get in touch</h3>
            <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
            <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
            <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" onkeypress="if(this.value.length == 11) return false;" class="box" required>
            <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
         </form>

      </section>


      <?php include 'components/footer.php'; ?>

      <script src="js/script.js"></script>

   </body>
</html>