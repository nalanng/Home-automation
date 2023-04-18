<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
        }
        header{
            position: relative;
            height: 10vh;
            background-color: #000;
            border-bottom: 1px solid rgb(203, 156, 122);
        }
        nav{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 5vh;
        }
        .sign-up{
            background-color: #fff;
            margin-left: 85vh;
        }
        .logo{
            background-color: #fff;
        }
        main{
            position: relative;
            height: 90vh;
            background-image: url(images/sign-in.png);
            background-size: cover ;
        }
        .producer-login{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 30vh;
            height: 50vh;
            text-align: center;
            border:1px solid  rgb(203, 156, 122);
            box-shadow:10px 10px 30px  rgb(203, 156, 122);
            background-color: rgb(203, 156, 122);
        }
        .content{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            height: 30vh;
            width: 100%;
        }
        
        .hh2{

            position: absolute;
            height: 10vh;
            width: 100%;
        }
        .hh2 h2{

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border-bottom: 2px solid rgb(0, 0, 0);
            width: 15vh;

            opacity: 100%;
        }  

        .content .empty{
            margin-top: 1vh;
        }   
        .content input{
            padding: 4%;
            margin-top: 1vh;
            margin-bottom: 3vh;
            border-radius: 5%;
        }
        .content input:hover{
            background-color: rgb(236, 206, 236);
            border-color: rgb(236, 206, 236);
        }
        .content input:active{
            background-color: #fff;
            border-color: #fff;
        }
        
        .login1 p{
            margin-top: 1vh;
            width: 18.5vh;
        }
        .login2 p{
            width: 16vh;
            margin-top: 3vh;
        }
        .login-b{
            margin-top: 40vh;
            text-align: center;

        }
    
        .error1 {
            color: #BE0202;
            position: absolute;
            left: 1%;
            top: 35%;
        }
        .error2 {
            color: #BE0202;
            position: absolute;
            right: 33%;
            top:80%;
            width: 150px;
            
        }
        .error3 {
            color: #BE0202;
            position: absolute;
            right: 35%;
            top:85%;
        }

    </style>
</head>
<body>
    <?php
       $idErr=$passwordErr="";
       $id=$password="";
       $err="";
        // we define variables to use if there are any validations
   
        // In this section we first control the method that is used for action
        // And then we give some error messages to the error values
        //If there are any blocks that was not filled this will give us an error
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           if(empty($_POST["id"])) {
               $idErr="*ID is required!";
           }
           else{
               $id=test_input($_POST["id"]);
               if(!(is_numeric($id))) {
                   $idErr="*ID must be only numeric values!";
               }
               
           }
           
           if(empty($_POST["password"])) {
               $passwordErr="*Password is required!";
           }
           else{
               $password=test_input($_POST["password"]);
           }
           //In this section we controlling the input values if they are
           // equal to the values we decided it will let consumer to login
           if(!(empty($_POST["id"])) && !(empty($_POST["password"]))){
            if($_POST["id"]=="20200808040" && $_POST["password"]=="123456") {
                header("location:homepage_customer.html");
                exit();
            }
            else {
                $err="*Invalid id/password!";
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
            <a class="logo" href="main-page.html"> <img src="images/logo.png" alt=""></a>
        </nav>
    </header>
        
    <main>
        <div class="producer-login">
            <div class="hh2">
                <h2>Login</h2>
            </div>
            <div class="content">
                <div class="empty"></div>
                <div class="login1">
                    <p>Customer ID</p>
                    <!-- In this section we print all the validation errors if there are any -->
                    <form method="POST" >
                    <input type="text" placeholder="Enter customer ID" name="id" value="<?php echo $id;?>">
                    <span class="error1"><?php echo $idErr;?></span>
                </div>
                <div class="login2">
                    <p>Password</p>
                    <input type="password" placeholder="Enter password" name="password" value="<?php echo $password;?>">
                    <span class="error2"><?php echo $passwordErr;?></span>
                    <span class="error3"><?php echo $err;?></span>
                </div>
                </div>
            <div class="login-b">
                <input type="submit" value="Login">
            </div> 
        </form>   
        </div>
    </main>
</body>
</html>