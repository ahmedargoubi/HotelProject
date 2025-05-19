<?php
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');
  
  session_start();
  
  if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');
  }
  
  if(isset($_POST['pay_now'])){

    $frm_data = filteration($_POST);
    
  
    $order_id = "ORD_".bin2hex(random_bytes(4))."_".date('dmY');
    $trans_id = "TXN_".bin2hex(random_bytes(4));
    
    
    $query = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, 
              `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`) 
              VALUES (?,?,?,?,?,?,?,?,?,?)";
    
    $values = [
      $_SESSION['uId'], 
      $_SESSION['room']['id'], 
      $frm_data['checkin'], 
      $frm_data['checkout'], 
      'booked', 
      $order_id, 
      $trans_id, 
      $_SESSION['room']['payment'], 
      'success', 
      'Payment successful'
    ];
    
   
    $datatypes = 'iisssssis';
    

    $datatypes .= 's';
    
 
    if(insert($query, $values, $datatypes)){
    
      alert('success', 'Booking Confirmed! Your booking ID is: '.$order_id);
      $_SESSION['room'] = null;
      redirect('bookings.php');
    } else {
      
      alert('error', 'Server error: '.mysqli_error($con));
      redirect('confirm_booking.php?id='.$_SESSION['room']['id']);
    }
  }
?>
