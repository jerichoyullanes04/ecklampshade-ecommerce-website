<?php
  // Database Connection (PHP PDO Method)

  $db_name = 'mysql:host=localhost;dbname=id21136862_shop_db';
  $user_name = 'id21136862_root';
  $user_password = 'PassWord#123';

  try {
      $conn = new PDO($db_name, $user_name, $user_password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

?>