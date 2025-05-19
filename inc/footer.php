<footer class="footer-dark text-white pt-5 pb-4">
  <div class="container">
    <div class="row">

      <!-- Logo & Description -->
      <div class="col-md-4 mb-4">
        <h3 class="fw-bold fs-4 mb-2"><?php echo $settings_r['site_title'] ?></h3>
        <p><?php echo $settings_r['site_about'] ?></p>
        
        <button class="btn btn-subscribe">Subscribe</button>
      </div>

      <!-- Navigation Links -->
      <div class="col-md-2 mb-4">
        <h5 class="fw-bold">NAVIGATION</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="footer-link">Home</a></li>
          <li><a href="rooms.php" class="footer-link">Rooms</a></li>
          <li><a href="facilities.php" class="footer-link">Facilities</a></li>
          <li><a href="contact.php" class="footer-link">Contact Us</a></li>
          <li><a href="about.php" class="footer-link">About</a></li>
        </ul>
      </div>

      <!-- Destinations -->
      <div class="col-md-2 mb-4">
        <h5 class="fw-bold">DESTINATIONS</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footer-link">Asia</a></li>
          <li><a href="#" class="footer-link">Africa</a></li>
          <li><a href="#" class="footer-link">Europe</a></li>
          <li><a href="#" class="footer-link">Middle East</a></li>
          <li><a href="#" class="footer-link">Pacific</a></li>
        </ul>
      </div>

      <!-- Professional -->
      <div class="col-md-2 mb-4">
        <h5 class="fw-bold">PROFESSIONAL</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footer-link">Development</a></li>
          <li><a href="#" class="footer-link">Press Room</a></li>
          <li><a href="#" class="footer-link">Careers</a></li>
          <li><a href="#" class="footer-link">Travel Pro</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-md-2 mb-4">
        <h5 class="fw-bold">FOLLOW US</h5>
        <?php 
          if($contact_r['tw']!=''){
            echo<<<data
              <a href="$contact_r[tw]" class="footer-link"><i class="bi bi-twitter me-1"></i> Twitter</a><br>
            data;
          }
        ?>
        <a href="<?php echo $contact_r['fb'] ?>" class="footer-link"><i class="bi bi-facebook me-1"></i> Facebook</a><br>
        <a href="<?php echo $contact_r['insta'] ?>" class="footer-link"><i class="bi bi-instagram me-1"></i> Instagram</a><br>
      </div>

    </div>
    <hr class="border-light">
    <div class="text-center small">
      &copy; 2025 Designed and Developed by Amey & Neal
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

  function alert(type,msg,position='body')
  {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if(position=='body'){
      document.body.append(element);
      element.classList.add('custom-alert');
    }
    else{
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
  }

  function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0; i<a_tags.length; i++)
    {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }

    }
  }

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'pass_mismatch'){
        alert('error',"Password Mismatch!");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email is already registered!");
      }
      else if(this.responseText == 'phone_already'){
        alert('error',"Phone number is already registered!");
      }
      else if(this.responseText == 'inv_img'){
        alert('error',"Only JPG, WEBP & PNG images are allowed!");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Image upload failed!");
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot send confirmation email! Server down!");
      }
      else if(this.responseText == 'ins_failed'){
        alert('error',"Registration failed! Server down!");
      }
      else{
        alert('success',"Registration successful. Confirmation link sent to email!");
        register_form.reset();
      }
    }

    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');

  login_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob',login_form.elements['email_mob'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email_mob'){
        alert('error',"Invalid Email or Mobile Number!");
      }
      else if(this.responseText == 'not_verified'){
        alert('error',"Email is not verified!");
      }
      else if(this.responseText == 'inactive'){
        alert('error',"Account Suspended! Please contact Admin.");
      }
      else if(this.responseText == 'invalid_pass'){
        alert('error',"Incorrect Password!");
      }
      else{
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php'){
          window.location = window.location.href;
        }
        else{
          window.location = window.location.pathname;
        }
      }
    }

    xhr.send(data);
  });

  let forgot_form = document.getElementById('forgot-form');

  forgot_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('email',forgot_form.elements['email'].value);
    data.append('forgot_pass','');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email'){
        alert('error',"Invalid Email !");
      }
      else if(this.responseText == 'not_verified'){
        alert('error',"Email is not verified! Please contact Admin");
      }
      else if(this.responseText == 'inactive'){
        alert('error',"Account Suspended! Please contact Admin.");
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot send email. Server Down!");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Account recovery failed. Server Down!");
      }
      else{
        alert('success',"Reset link sent to email!");
        forgot_form.reset();
      }
    }

    xhr.send(data);
  });

  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href='confirm_booking.php?id='+room_id;
    }
    else{
      alert('error','Please login to book room!');
    }
  }

  setActive();

</script>