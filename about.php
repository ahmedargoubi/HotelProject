<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - ABOUT</title>
  <style>
    .box{
      border-top-color: var(--teal) !important;
    }
    .h-font {
    
    color: #8c7343;
  }

   .btn-dark {
    background-color: #8c7343;
    border: none;
    transition: all 0.3s ease;
  }
  
  .btn-dark:hover {
    background-color:  #e9c58a;
    transform: translateY(-2px);
  }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="container-fluid px-0 mb-5">
  <div class="row mx-0">
    <div class="col-md-12 px-0">
      <div class="position-relative">
        <img src="images/about/mov.jpg" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0,0,0,0.4);">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <h1 class="text-white display-4 fw-bold">ABOUT US</h1>
                <p class="text-white lead mb-4">
                  On the horizon of Tunisia's liveliest town lies the Mövenpick Resort & Marine Spa Sousse. 
                  Stretched out along a sparkling beachfront, this exquisite getaway offers all you expect 
                  from a perfect holiday experience.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Exquisite Getaway Section -->
<div class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-6 mb-4">
      <h2 class="fw-bold h-font mb-4">AN EXQUISITE GETAWAY IN SOUSSE!</h2>
      <p class="mb-4">
        Our 5-star resort is located in the heart of Sousse and has access to a
        private beach as well as our saltwater outdoor pool at the hotel.
        Mövenpick's Marine Spa gives a new meaning to indulgence and offers a
        large range of treatments as well as a sound to extend your period of
        relaxation.
      </p>
      <a href="#" class="btn btn-dark px-4 py-2">EXPLORE</a>
    </div>
   
  </div>
</div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/customers.svg" width="70px">
          <h4 class="mt-3">200+ CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/rating.svg" width="70px">
          <h4 class="mt-3">150+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/staff.svg" width="70px">
          <h4 class="mt-3">200+ STAFFS</h4>
        </div>
      </div>
    </div>
  </div>

 

  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>


</body>
</html>