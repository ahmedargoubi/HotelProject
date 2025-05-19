<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mövenpick Sousse - BOOKINGS</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <style>
    .custom-bg {
      background-color: #2ec1ac;
    }
    h2.fw-bold {
      color: #2a2a2a;
    }
    .nav-custom {
      background-color: white;
      box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
    }
    .footer-custom {
      background-color: #1a1a1a;
      color: white;
    }
  </style>
</head>
<body class="bg-light">

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3" href="index.php">
        
      </a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rooms.php">Rooms</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="facilities.php">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
        <div class="d-flex">
          <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2">
            ahmed <i class="bi bi-person-fill"></i>
          </button>
          <button type="button" class="btn btn-outline-dark shadow-none">
            Logout
          </button>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">BOOKINGS</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
        </div>
      </div>

      <!-- Sample Booking Cards (You would dynamically generate these from your database) -->
      <div class='col-md-4 px-4 mb-4'>
        <div class='bg-white p-3 rounded shadow-sm'>
          <h5 class='fw-bold'>Deluxe Sea View</h5>
          <p>$2500 per night</p>
          <p>
            <b>Check in: </b> 15-05-2025 <br>
            <b>Check out: </b> 18-05-2025
          </p>
          <p>
            <b>Amount: </b> $7500 <br>
            <b>Order ID: </b> ORD123456 <br>
            <b>Date: </b> 10-05-2025
          </p>
          <p>
            <span class='badge bg-success'>booked</span>
          </p>
          <button onclick='cancel_booking(123)' type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>
        </div>
      </div>

      <div class='col-md-4 px-4 mb-4'>
        <div class='bg-white p-3 rounded shadow-sm'>
          <h5 class='fw-bold'>Premium Garden View</h5>
          <p>$2000 per night</p>
          <p>
            <b>Check in: </b> 05-04-2025 <br>
            <b>Check out: </b> 08-04-2025
          </p>
          <p>
            <b>Amount: </b> $6000 <br>
            <b>Order ID: </b> ORD789012 <br>
            <b>Date: </b> 01-04-2025
          </p>
          <p>
            <span class='badge bg-danger'>cancelled</span>
          </p>
          <a href='generate_pdf.php?gen_pdf&id=456' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>
        </div>
      </div>

      <div class='col-md-4 px-4 mb-4'>
        <div class='bg-white p-3 rounded shadow-sm'>
          <h5 class='fw-bold'>Executive Suite</h5>
          <p>$3500 per night</p>
          <p>
            <b>Check in: </b> 20-03-2025 <br>
            <b>Check out: </b> 22-03-2025
          </p>
          <p>
            <b>Amount: </b> $7000 <br>
            <b>Order ID: </b> ORD345678 <br>
            <b>Date: </b> 15-03-2025
          </p>
          <p>
            <span class='badge bg-success'>booked</span>
          </p>
          <a href='generate_pdf.php?gen_pdf&id=789' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>
          <button type='button' onclick='review_room(789,12)' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Rate & Review</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Review Modal -->
  <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="review-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i> Rate & Review
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Rating</label>
              <select class="form-select shadow-none" name="rating">
                <option value="5">Excellent</option>
                <option value="4">Good</option>
                <option value="3">Ok</option>
                <option value="2">Poor</option>
                <option value="1">Bad</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Review</label>
              <textarea type="password" name="review" rows="3" required class="form-control shadow-none"></textarea>
            </div>
            
            <input type="hidden" name="booking_id">
            <input type="hidden" name="room_id">

            <div class="text-end">
              <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="container-fluid bg-dark text-white mt-5 pt-5 px-0">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mb-4">
          <h3>MÖVENPICK SOUSSE</h3>
          <p>Sign up to our newsletter for juicy offers and sweet new openings</p>
          <button class="btn btn-warning">Subscribe</button>
        </div>
        <div class="col-md-3 mb-4">
          <h5>NAVIGATION</h5>
          <ul class="list-unstyled">
            <li><a href="index.php" class="text-decoration-none text-white">Home</a></li>
            <li><a href="rooms.php" class="text-decoration-none text-white">Rooms</a></li>
            <li><a href="facilities.php" class="text-decoration-none text-white">Facilities</a></li>
            <li><a href="contact.php" class="text-decoration-none text-white">Contact Us</a></li>
            <li><a href="about.php" class="text-decoration-none text-white">About</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-4">
          <h5>DESTINATIONS</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-decoration-none text-white">Asia</a></li>
            <li><a href="#" class="text-decoration-none text-white">Africa</a></li>
            <li><a href="#" class="text-decoration-none text-white">Europe</a></li>
            <li><a href="#" class="text-decoration-none text-white">Middle East</a></li>
            <li><a href="#" class="text-decoration-none text-white">Pacific</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-4">
          <h5>FOLLOW US</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-twitter me-2"></i>Twitter</a></li>
            <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
            <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
          </ul>
        </div>
      </div>
      <div class="row border-top pt-3 mt-3">
        <div class="col-12 text-center">
          <p>© 2025 Designed and Developed by Arney & Neal</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

  <script>
    function cancel_booking(id) {
      if(confirm('Are you sure to cancel booking?')) {
        // Demo functionality - in real scenario this would send an AJAX request
        alert('Booking cancelled! You would be redirected in a real scenario.');
      }
    }

    review_form.addEventListener('submit', function(e) {
  e.preventDefault();
  
  let data = new FormData();
  data.append('booking_id', review_form.elements['booking_id'].value);
  data.append('room_id', review_form.elements['room_id'].value);
  data.append('rating', review_form.elements['rating'].value);
  data.append('review', review_form.elements['review'].value);
  data.append('review_form', '');
  
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/review_room.php", true);
  
  xhr.onload = function() {
    if(this.responseText == 1) {
      alert('success', 'Review submitted successfully!');
      review_form.reset();
      var myModal = document.getElementById('reviewModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
    } else {
      alert('error', 'Review submission failed!');
    }
  }
  
  xhr.send(data);
});

// 2. Make sure the alert function is defined
function alert(type, msg) {
  let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
  let element = document.createElement('div');
  element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
      <strong>${msg}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
  document.body.append(element);
  setTimeout(() => element.remove(), 5000);
}
  </script>

</body>
</html>