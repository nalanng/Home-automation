<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      * {
        margin: 0;
      }
      header {
        position: relative;
        height: 10vh;
        background-color: #000;
        border-bottom: 1px solid rgb(203, 156, 122);
      }
      nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        margin-left: 5vh;
        width: 100%;
      }
      .logo {
        position: absolute;
        left: 0;
        background-color: #fff;
      }
      main {
        position: relative;
        height: 90vh;
        background-image: url(images/sign-in.png);
        background-size: cover;
      }
      .customer-sign-up {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        height: 80vh;
        text-align: center;
        border: 1px solid rgb(203, 156, 122);
        box-shadow: 10px 10px 30px rgb(203, 156, 122);
        background-color: rgb(203, 156, 122);
      }
      .hh2 {
        position: absolute;
        height: 10vh;
        width: 100%;
      }
      .hh2 h2 {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-bottom: 2px solid rgb(0, 0, 0);
        width: 15vh;
        opacity: 100%;
      }
      #s-up {
        position: absolute;
        width: 100%;
        top: 150%;
      }
      input {
        width: 75%;
        margin-bottom: 2%;
      }
      #last-i {
        margin-bottom: 15px;
      }
      #s-up p {
        margin-left: 12.5%;
        text-align: left;
      }
      #sign-up-b {
        position: absolute;
        bottom: 12%;
        width: 30%;
        height: 5%;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 50%;
        background-color: rgb(220, 194, 238);
        color: #000000;
        font-weight: bolder;
      }
      #sign-up-b:hover {
        background-color: rgb(88, 8, 75);
        color: #fff;
      }
      #sign-up-b:active {
        background-color: rgb(220, 194, 238);
        color: #000000;
      }
      #button {
        position:absolute;
        top: 85%;
        width: 40%;
        left:30%;
        height: 35px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 110%;
      }
      .error1{
        position: absolute;
        top: 450px;
        left: 110px;
        color: #BE0202;
      }
      .nameerror {
        position: absolute;
        top: 450px;
        left: 110px;
        color: #BE0202;
      }
      .iderror {
        position: absolute;
        top: 450px;
        left: 110px;
        color: #BE0202;
      }
      .emailerror {
        position: absolute;
        top: 450px;
        left: 110px;
        color: #BE0202;
      }
      .error2 {
        position: absolute;
        top: 450px;
        left: 110px;
        color: #BE0202;
      }
    </style>
  </head>
  <body>
      <?php
        $nameErr=$idErr=$emailErr=$numberErr=$phoneErr="";
        $name=$id=$email=$number=$password1=$password2="";
        $error1="";
        $error2="";

        // we define variables to use if there are any validations
   
        // In this section we first control the method that is used for action
        // And then we give some error messages to the error values
        //If there are any blocks that was not filled this will give us an error
        // Program will control all of the inputs by order and give error messages accoarding to the error

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["name"])||empty($_POST["id"])||empty($_POST["email"])||empty($_POST["number"])
            ||empty($_POST["password1"])||empty($_POST["password2"])) {
                $error1="*All fields should be filled!";
            }
            else {
                $email=test_input($_POST["email"]);
                $id=test_input($_POST["id"]);
                $name=test_input($_POST["name"]);
                $password1=test_input($_POST["password1"]);
                $password2=test_input($_POST["password2"]);

                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $nameErr = "*Use only letters and space in name!";
                }
                else if(!(is_numeric($id))) {
                    $idErr="*ID must be only numeric values!";
                }
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "*Invalid email format!";
                }
                else if($_POST["password1"]!=$_POST["password2"]) {
                    $error2="*Passwords do not match";
                }
                else {
                    header("location:homepage_customer.html");
                    exit(); 
                }
            }
        }
        // In this function we strip unnecessary characters and
       // turn the input into a safer mode
        function test_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
      ?>
    <header>
      <nav>
        <!-- Clicking on the logo lead you to the home page -->
        <a class="logo" href="main-page.html"><img src="images/logo.png" alt=""></a>
      </nav>
    </header>

    <main>
      <div class="customer-sign-up">
        <div class="hh2">
          <h2>Sign Up</h2>
          <form method="POST">
          <div id="s-up">
            <p>Name / Surname</p>
            <input type="text" placeholder="Enter your name and surname" name="name" value="<?php echo $name;?>"/>
            <p>Customer ID</p>
            <input type="text" placeholder="Enter a customer ID" name="id"value="<?php echo $id;?>" />
            <p>E-mail</p>
            <input type="email" placeholder="Enter your e-mail" name="email"value="<?php echo $email;?>"/>
            <p>Phone Number</p>
            <input type="number" placeholder="Enter your phone number" name="number"value="<?php echo $number;?>"/>
            <p>Password</p>
            <input type="password" placeholder="Enter your password" name="password1" value="<?php echo $password1;?>"/>
            <p>Password</p>
            <input
              type="password"
              name="password2"
              id="last-i"
              placeholder="Enter your password" value="<?php echo $password2;?>"
            />
          </div>
          <!-- In this section we print all the validation errors if there are any -->
          <span class="error1"><?php echo $error1;?></span>
          <span class="nameerror"><?php echo $nameErr;?></span>
          <span class="iderror"><?php echo $idErr;?></span>
          <span class="emailerror"><?php echo $emailErr;?></span>
          <span class="error2"><?php echo $error2;?></span>
        </div>
      </div>
      <div>
      <input id="button" type="submit" value="Sign up">
      </div>
      </form>
    </main>
  </body>
</html>
