<?php
   include '../components/connect.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:admin_login.php');
   };

   // Delete Button Function
   if(isset($_POST['delete'])){
      $message_id = $_POST['message_id']; // Get the message_id from the form
      $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
      if ($delete_message->execute([$message_id])) { // Use $message_id in parameter to delete message from the database
        echo '<script>alert("Message deleted successfully!")</script>';
        /* echo "Message deleted successfully!"; */
      } else {
         echo "Error deleting message: " . $delete_message->errorInfo()[2];
      }
/*header('location:messages.php');*/
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Messages</title>
      <link rel="icon" type="image/x-icon" href="/images/icons/favicon.png"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="../css/admin_style.css">
   </head>
   <body>

      <?php include '../components/admin_header.php'; ?>

      <section class="contacts">
         <h1 class="heading">messages</h1>
         <div class="box-container">
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               if($select_messages->rowCount() > 0){
                  while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                     ?>
                     <form action="" method="post" >
                        <div class="box">
                        <input type="hidden" name="message_id" value="<?= $fetch_message['id']; ?>">
                        <p> user id : <span><?= $fetch_message['user_id']; ?></span></p>
                        <p> name : <span><?= $fetch_message['name']; ?></span></p>
                        <p> email : <span><?= $fetch_message['email']; ?></span></p>
                        <p> number : <span><?= $fetch_message['number']; ?></span></p>
                        <p> message : <span><?= $fetch_message['message']; ?></span></p>
                        <input type="submit" value="delete message" onclick="return confirm('delete this message?');" class="delete-btn" name="delete">
                        </div>
                     </form>
                     <?php
                  }
               }else{
                  echo '<p class="empty">you have no messages</p>';
               }
            ?>
         </div>
      </section>

      <script src="../js/admin_script.js"></script>
         
   </body>
</html>