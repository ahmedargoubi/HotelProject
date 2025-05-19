<?php 

  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');
  
  date_default_timezone_set("Africa/Tunis");

 
  function send_mail($uemail, $token, $type)
  {
    $page = 'index.php';
    $subject = "Account Reset Link";
    

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Mövenpick Resort & Marine Spa Sousse <noreply@movenpick-sousse.com>" . "\r\n";
    
   
    $message = "
      <html>
      <head>
        <title>Password Reset</title>
      </head>
      <body>
        <p>Click the link to reset your account:</p>
        <p><a href='".SITE_URL."$page?$type&email=$uemail&token=$token"."'>Reset Password</a></p>
        <p>If you did not request this password reset, please ignore this email.</p>
      </body>
      </html>
    ";
    
   
    try {
      $mail_sent = mail($uemail, $subject, $message, $headers);
      return $mail_sent ? 1 : 0;
    }
    catch (Exception $e) {
      return 0;
    }
  }

  if(isset($_POST['register']))
  {
    $data = filteration($_POST);

    // Validate password match
    if($data['pass'] != $data['cpass']) {
      echo 'pass_mismatch';
      exit;
    }

    // Check if user already exists
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1",
      [$data['email'], $data['phonenum']], "ss");

    if(mysqli_num_rows($u_exist) != 0) {
      $u_exist_fetch = mysqli_fetch_assoc($u_exist);
      echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
      exit;
    }

    // Modified image handling to be more robust
    if(isset($_FILES['profile']) && $_FILES['profile']['error'] == 0 && !empty($_FILES['profile']['name'])) {
      // Proceed with normal image upload
      $img = uploadUserImage($_FILES['profile']);
      
      if($img == 'inv_img') {
        echo 'inv_img';
        exit;
      }
      else if($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
      }
    } else {
      // Use default image if none provided or there was an upload error
      $img = 'default_avatar.jpg'; // Make sure this default image exists in your upload folder
    }

    $token = NULL; 
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`,
      `profile`, `password`, `token`, `is_verified`) VALUES (?,?,?,?,?,?,?,?,?,?)";
      
    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['pincode'], $data['dob'],
      $img, $enc_pass, $token, 1]; 

    // Try to insert and provide better error handling
    try {
      $inserted = insert($query, $values, 'sssssssssi');
      if($inserted) {
        echo 1;
      } else {
        // Log the error for debugging
        error_log("User registration failed: " . mysqli_error($GLOBALS['con']));
        echo 'ins_failed';
      }
    } catch (Exception $e) {
      error_log("Exception during registration: " . $e->getMessage());
      echo 'ins_failed';
    }
  }

  if(isset($_POST['login']))
  {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email_mob'], $data['email_mob']], "ss");

    if(mysqli_num_rows($u_exist) == 0) {
      echo 'inv_email_mob';
    }
    else {
      $u_fetch = mysqli_fetch_assoc($u_exist);
      
      if($u_fetch['status'] == 0) {
        echo 'inactive';
      }
      else {
        if(!password_verify($data['pass'], $u_fetch['password'])) {
          echo 'invalid_pass';
        }
        else {
          session_start();
          $_SESSION['login'] = true;
          $_SESSION['uId'] = $u_fetch['id'];
          $_SESSION['uName'] = $u_fetch['name'];
          $_SESSION['uPic'] = $u_fetch['profile'];
          $_SESSION['uPhone'] = $u_fetch['phonenum'];
          echo 1;
        }
      }
    }
  }

  if(isset($_POST['forgot_pass']))
  {
    $data = filteration($_POST);
    
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], "s");

    if(mysqli_num_rows($u_exist) == 0) {
      echo 'inv_email';
    }
    else {
      $u_fetch = mysqli_fetch_assoc($u_exist);
      
      if($u_fetch['status'] == 0) {
        echo 'inactive';
      }
      else {
      
        $token = bin2hex(random_bytes(16));

        if(!send_mail($data['email'], $token, 'account_recovery')) {
          echo 'mail_failed';
        }
        else {
          $date = date("Y-m-d");
          
          
          $query = "UPDATE `user_cred` SET `token`=?, `t_expire`=? WHERE `id`=?";
          $values = [$token, $date, $u_fetch['id']];
          
          if(update($query, $values, 'ssi')) {
            echo 1;
          }
          else {
            echo 'upd_failed';
          }
        }
      }
    }
  }

  if(isset($_POST['recover_user']))
  {
    $data = filteration($_POST);
    
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=? 
      WHERE `email`=? AND `token`=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if(update($query, $values, 'sssss')) {
      echo 1;
    }
    else {
      echo 'failed';
    }
  }
  
?>