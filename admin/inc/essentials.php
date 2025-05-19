<?php 

  

  define('SITE_URL','http://127.0.0.1/HotelProject/');
  define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
  define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
  define('FACILITIES_IMG_PATH',SITE_URL.'images/facilities/');
  define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
  define('USERS_IMG_PATH',SITE_URL.'images/users/');



  define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/HotelProject/images/');
  define('ABOUT_FOLDER','about/');
  define('CAROUSEL_FOLDER','carousel/');
  define('FACILITIES_FOLDER','facilities/');
  define('ROOMS_FOLDER','rooms/');
  define('USERS_FOLDER','users/');




  function adminLogin()
  {
    session_start();
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
      echo"<script>
        window.location.href='index.php';
      </script>";
      exit;
    }
  }

  function redirect($url){
    echo"<script>
      window.location.href='$url';
    </script>";
    exit;
  }

  function alert($type,$msg){    
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
      <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
        <strong class="me-3">$msg</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    alert;
  }

  function uploadImage($image,$folder)
  {
    $valid_mime = ['image/jpeg','image/png','image/webp'];
    $img_mime = $image['type'];

    if(!in_array($img_mime,$valid_mime)){
      return 'inv_img'; 
    }
    else if(($image['size']/(1024*1024))>10){
      return 'inv_size'; 
    }
    else{
      $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
      $rname = 'IMG_'.random_int(11111,99999).".$ext";

      $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
      if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
      }
      else{
        return 'upd_failed';
      }
    }
  }

  function deleteImage($image, $folder)
  {
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
      return true;
    }
    else{
      return false;
    }
  }

  function uploadSVGImage($image,$folder)
  {
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if(!in_array($img_mime,$valid_mime)){
      return 'inv_img'; //invalid image mime or format
    }
    else if(($image['size']/(1024*1024))>1){
      return 'inv_size'; //invalid size greater than 1mb
    }
    else{
      $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
      $rname = 'IMG_'.random_int(11111,99999).".$ext";

      $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
      if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
      }
      else{
        return 'upd_failed';
      }
    }
  }

  


function uploadUserImage($image) 
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $valid_ext = ['jpg', 'jpeg', 'png', 'webp'];
    
    $img_mime = $image['type'];
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
    // Validate image type
    if(!in_array($img_mime, $valid_mime) || !in_array($img_ext, $valid_ext)) {
        return 'inv_img';
    }
    
    // Create random name for image
    $rname = 'USER_' . random_int(11111, 99999) . '.' . $img_ext;
    
    // Make sure constants are defined
    if(!defined('UPLOAD_IMAGE_PATH')) {
        define('UPLOAD_IMAGE_PATH', '../uploads/');
    }
    
    if(!defined('USERS_FOLDER')) {
        define('USERS_FOLDER', 'users/');
    }
    
    // Create directories if they don't exist
    if(!is_dir(UPLOAD_IMAGE_PATH)) {
        mkdir(UPLOAD_IMAGE_PATH, 0755);
    }
    
    if(!is_dir(UPLOAD_IMAGE_PATH . USERS_FOLDER)) {
        mkdir(UPLOAD_IMAGE_PATH . USERS_FOLDER, 0755);
    }
    
    $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;
    
    // Attempt to upload
    if(move_uploaded_file($image['tmp_name'], $img_path)) {
        return $rname;
    } else {
        return 'upd_failed';
    }
}



?>
