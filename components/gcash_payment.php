<?php 
    if(isset($_POST['gcash_login'])){
        echo '<script>alert("Online Payment Successful")</script>';
        echo "<script>setTimeout(\"location.href = '../orders.php';\",300);</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="/images/icons/gcash-favicon.png"> 
        <link rel="stylesheet" href="../css/gcash.css">
        <title>GCash Payment</title>

    </head>
    <body>
        <div class="header">
            <img src="../images/GCash-Full-Blue-Logo.jpg" alt="">
        </div>
        <div class="form-container">
            <div class="form">
                <form action="" method="POST" >
                <p class="title"> Login your GCash to process your payment  </p>
                    <label for="fname">Enter your GCash Number:</label>
                    <input type="number" min="0" max="9999999999" onkeypress="if(this.value.length == 11) return false;" required>
                    <label for="lname">Enter your 4  digit MPIN:</label>
                    <input type="password"  maxlength= "4" required>
                    <input type="submit" value="N E X T" name="gcash_login" >
                </form>
            </div>
        </div>
    </body>
</html>