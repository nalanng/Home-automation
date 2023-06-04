<?php
  include("connection.php");

  $email=$password=$email_err=$password_err="";

  if(isset($_POST["button"])) {
    if(empty($_POST["email"])) {
      $email_err="Email is required!";
    }
    else {
      $email=$_POST["email"];
    }
    if(empty($_POST["password"])) {
      $password_err="Password is required!";
    }
    else {
      $password=$_POST["password"];
    }
   
    if(isset($email) && isset($password)) {
      $select = "SELECT * FROM producerinfo WHERE ProducerEmail='$email'";
      $start = mysqli_query($connection,$select);

      if (mysqli_num_rows($start) > 0) { 
        $row = mysqli_fetch_assoc($start);

        if($password==$row["ProducerPassword"]) {
          header("location:producer.php");
        }
      }
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
header#header.producer a#signup {
  position: absolute;
  right: 30px;
  border: 1px solid rgba(89, 237, 200, 0.907);
  background-color: rgba(89, 237, 200, 0.907);
  border-radius: 20px;
  top: 10px;
}
header#header.producer a#signinc {
  position: absolute;
  right: 150px;
  border: 1px solid rgba(89, 237, 200, 0.907);
  background-color: rgba(89, 237, 200, 0.907);
  border-radius: 20px;
  top: 10px;
}
header#header.producer a#signinp {
  position: absolute;
  right: 370px;
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
        <li><a href="signup.php" id="signup">Sign Up</a></li>
        <li><a href="login_c.php" id="signinc">Sign In As Consumer</a></li>
        <li><a href="login_p.php" id="signinp">Sign In As Producer</a></li>
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
              <h2 class="text-uppercase text-center mb-5">Please Sign In AS PRODUCER</h2>

              <form action="login_p.php" method="POST" >
                <div class="form-outline mb-3">
                <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="form3Example3cg" class="form-control <?php
                    if(!empty($email_err)) {
                      echo "is-invalid";
                    }
                    ?>" name="email"/>
                    <div class="invalid-feedback">
                    <?php
                    echo $email_err;
                    ?>
                    </div>
                </div>
                <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4cg">Password</label>
                  <input type="password" id="form3Example4cg" class="form-control  <?php
                    if(!empty($password_err)) {
                      echo "is-invalid";
                    }
                    ?>" name="password"/>
                     <div class="invalid-feedback">
                    <?php
                    echo $password_err;
                    ?>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="sumbit" name="button"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Sign In</button>
                </div>

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




