<?php
  include("connection.php");

  $name_err=$email_err=$password_err=$phone_err=$password2_err="";

  if(isset($_POST["signup"])) {
    if(empty($_POST["name"])) {
      $name_err="Name is required!";
    }
    else if (preg_match('/^[a-z\d_]{5,20}$/i', $_POST["name"])) {
      $name_err="Invalid characters!";
    } 
    else {
      $name=$_POST["name"];
    }
    if(empty($_POST["email"])) {
      $email_err="Password is required!";
    }
    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format";
    }
    else {
      $email=$_POST["email"];
    }
    if(empty($_POST["phone"])) {
      $phone_err="Phone is required!";
    }
    else {
      $phone=$_POST["phone"];
    }
    if(empty($_POST["password"])) {
      $password_err="Password is required!";
    }
    else if(strlen($_POST["password"])<3) {
      $password_err="Password should be more than 3 characters!";
    }
    else {
      $password=$_POST["password"];
    }
    if(empty($_POST["password2"])) {
      $password2_err="Password is required!";
    }
    else if($_POST["password"]!=$_POST["password2"]) {
      $password2_err="Passwords do not match";
    }
    else {
      $password2=$_POST["password2"];
    }
    if(isset($name) && isset($email) && isset($phone) && isset($password)&& isset($password2)) {


    $add = "INSERT INTO consumerinfo (ConsumerNameSurname, ConsumerEmail,
    ConsumerPhoneNumber, ConsumerPassword) VALUES ('$name','$email','$phone','$password')";
    $start = mysqli_query($connection,$add);

    mysqli_close($connection);
  }
  }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<style>
body {
  margin: 0;
}
/* header */
header#header.producer {
  border-bottom: 1px solid rgba(89, 237, 200, 0.4);
  width: 100%;
  left: 0%;
}
li {
  display: inline;
  list-style: none;
}
header#header.producer a {
  text-decoration: none;
  font-size: large;
  color: black;
  padding: 8px;
  padding-left: 20px;
  padding-right: 20px;
}
header#header.producer a#logo {
  padding-left: 0;
  font-size: xx-large;
}
header#header.producer a#signOut {
  position: absolute;
  right: 30px;
  border: 1px solid rgba(89, 237, 200, 0.907);
  background-color: rgba(89, 237, 200, 0.907);
  border-radius: 20px;
  top: 10px;
}
.gradient-custom-3 {

background: #84fab0;
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
}
.gradient-custom-4 {
background: #84fab0;

background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}

    
</style>
<header class="producer" id="header">
      <ul>
        <li>
          <a href="#" id="logo">SNautomation</a>
        </li>
        <li><a href="#" id="signOut">Sign Out</a></li>
      </ul>
    </header>
<body>
<section>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-3">Create an account</h2>

              <form action="signup.php" method="POST">
                <div class="form-outline mb-3">
                  <input type="text" id="validationCustom03" class="form-control" name="name" required />
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <?php
                    if(!empty($name_err)) {
                      echo "is-invalid";
                    }
                    ?>
                    <?php
                    echo $name_err;
                    ?>
                </div>

                <div class="form-outline mb-3">
                  <input type="email" id="validationCustom03" class="form-control" name="email" required/>
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <?php
                    if(!empty($email_err)) {
                      echo "is-invalid";
                    }
                    ?>
                  <?php
                    echo $email_err;
                    ?>
                </div>

                <div class="form-outline mb-3">
                <input type="tel" id="phone" name="phone" id="validationCustom03" class="form-control required" 
                placeholder="5xx-xxx-xx-xx" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required>
                <label class="form-label" for="form3Example1cg">Phone Number</label>
                <?php
                    if(!empty($phone_err)) {
                      echo "is-invalid";
                    }
                    ?>
                  <?php
                    echo $phone_err;
                    ?>
                </div>
                

                <div class="form-outline mb-3">
                  <input type="password" id="validationCustom03" class="form-control" name="password" required />
                  <label class="form-label" for="form3Example4cg">Password</label>
                  <?php
                    if(!empty($password_err)) {
                      echo "is-invalid";
                    }
                    ?>
                  <?php
                    echo $password_err;
                    ?>
                </div>

                <div class="form-outline mb-3">
                  <input type="password" id="validationCustom03" class="form-control" name="password2" required/>
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                  <?php
                    if(!empty($password2_err)) {
                      echo "is-invalid";
                    }
                    ?>
                  <?php
                    echo $password2_err;
                    ?>
                </div>

                <div class="d-flex justify-content-center">
                  <button name="signup" type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Sign Up</button>
                    
                </div>

                <p class="text-center text-muted mt-4 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>