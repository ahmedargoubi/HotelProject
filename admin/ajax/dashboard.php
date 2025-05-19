<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if(isset($_POST['booking_analytics']))
{
  $frm_data = filteration($_POST);
  
  $condition = "";
  
  if($frm_data['period']==1){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
  }
  else if($frm_data['period']==2){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
  }
  else if($frm_data['period']==3){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
  }

  $total_query = "SELECT COUNT(booking_id) AS `total_bookings`, 
    SUM(trans_amt) AS `total_amt` FROM `booking_order` $condition";

  $active_query = "SELECT COUNT(booking_id) AS `active_bookings`, 
    SUM(trans_amt) AS `active_amt` FROM `booking_order` 
    $condition AND booking_status!='cancelled'";

  $cancelled_query = "SELECT COUNT(booking_id) AS `cancelled_bookings`, 
    SUM(trans_amt) AS `cancelled_amt` FROM `booking_order` 
    $condition AND booking_status='cancelled'";

  // Handle database errors gracefully
  $total_res = mysqli_query($con, $total_query);
  $total_data = ($total_res) ? mysqli_fetch_assoc($total_res) : ['total_bookings'=>0, 'total_amt'=>0];
  
  $active_res = mysqli_query($con, $active_query);
  $active_data = ($active_res) ? mysqli_fetch_assoc($active_res) : ['active_bookings'=>0, 'active_amt'=>0];
  
  $cancelled_res = mysqli_query($con, $cancelled_query);
  $cancelled_data = ($cancelled_res) ? mysqli_fetch_assoc($cancelled_res) : ['cancelled_bookings'=>0, 'cancelled_amt'=>0];

  // Make sure all values are properly defined
  $data = [
    'total_bookings' => $total_data['total_bookings'] ?? 0,
    'total_amt' => $total_data['total_amt'] ?? 0,
    'active_bookings' => $active_data['active_bookings'] ?? 0,
    'active_amt' => $active_data['active_amt'] ?? 0,
    'cancelled_bookings' => $cancelled_data['cancelled_bookings'] ?? 0,
    'cancelled_amt' => $cancelled_data['cancelled_amt'] ?? 0,
  ];

  // Convert null values to 0
  foreach($data as $key => $value){
    $data[$key] = ($value == NULL) ? 0 : $value;
  }

  $data = json_encode($data);
  echo $data;
}

if(isset($_POST['user_analytics']))
{
  $frm_data = filteration($_POST);
  
  $condition = "";
  
  if($frm_data['period']==1){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
  }
  else if($frm_data['period']==2){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
  }
  else if($frm_data['period']==3){
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
  }

  // Function to check if a table exists
  function table_exists($table_name) {
    global $con;
    $result = mysqli_query($con, "SHOW TABLES LIKE '$table_name'");
    return mysqli_num_rows($result) > 0;
  }

  $total_new_reg = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) AS `count` FROM `user_cred` $condition"));
  
  $total_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `user_queries` $condition"));
  
  // Check if rating_review table exists
  if(table_exists('rating_review')) {
    $total_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `rating_review` $condition"));
  } else {
    $total_reviews = ['count' => 0]; // Default value if table doesn't exist
  }

  $data = [
    'total_new_reg' => $total_new_reg['count'] ?? 0,
    'total_queries' => $total_queries['count'] ?? 0,
    'total_reviews' => $total_reviews['count'] ?? 0,
  ];

  // Convert null values to 0
  foreach($data as $key => $value){
    $data[$key] = ($value == NULL) ? 0 : $value;
  }

  $data = json_encode($data);
  echo $data;
}

?>