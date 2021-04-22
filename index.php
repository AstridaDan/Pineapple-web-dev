<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css?v=<?php echo time(); ?>" type="text/css" media="all"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="./resources/fontawesome/css/brands.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>pineapple.</title>
    
</head>

<body>
<?php
require_once('config.php');

$errors = [];
$email = "";

if(empty($_POST['email'])) {
    if(empty($_POST['JSerror']) && !isset($_POST['JSerror'])) {
        $errors['email'] = "Email address is required";
    }
  } else {
    $email = test_input($_POST["email"]);
    $lastTwo = substr($email, -2);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Please provide a valid e-mail address";
    }
    else if (!isset($_POST['checkbox'])) {
      $errors['email'] = "You must accept the terms and conditions";
    }
    else if ($lastTwo == "co"){
      $errors['email'] = "We are not accepting subscriptions from Colombia emails";
    }
    else{
      $errors = array();
    }
}

// check if no errors , insert it to your DB :
if(count($errors) <= 0 ) {
  $mysql = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
  $data = array_map( array( $mysql, 'real_escape_string' ), $_POST ); 

  //Convert to variables
  extract( $data );

  //Submit to database
  $query = "INSERT INTO users (email) VALUES ('$email')";
  $insert = $mysql->query( $query );
}

function test_input($info) {
  $info = trim($info);
  $info = stripslashes($info);
  $info = htmlspecialchars($info);
  return $info;
}

function js_link($src)
{
    if(file_exists("my/html/root/" . $src))    {
        //we know it will exists within the HTTP Context
        return sprintf("<script type=\"text/javascript\" src=\"%s\"></script>",$src);
    }
    return "<!-- Unable to load " . $src . "-->";
}
?>
    <!--FIRST COLUMN-->
    <div class="first-column">
        <nav id="nav" class="nav">
            <span class="logo-group">
                <a href="#">
                    <img class="logo" src="./img/logo.svg" alt="Logo">
                    <img class="logo-text" src="./img/pineapple..svg" alt="Logo">
                </a>
            </span>
            <span class="menu">
                <a href="#">About</a>
                <a href="#">How it works</a>
                <a href="#">Contact</a>
            </span>
        </nav>

        <!--Text with input-->
        <div class="subscribe">
            <!-- Go to success page -->
            <?php if (isset($insert)) : ?>
                <div class="message">
                <?php if ($insert == true) :
                    //Prevent from submit on page reload, go on success submit
                    header('Location: success.php'); ?>
                <?php else : ?>
                    <p> Not success </p>
                <?php endif; ?>
                </div>
            <?php endif; ?>

            <img id="success-logo" src="./img/ic_success.svg" alt="Success Logo">
            <h1 class="title" id="title">Subscribe to newsletter</h1>
            <p class="paragraph" id="paragraph">Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
            <form
                novalidate
                id="myForm"
                method="POST"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <div class="input-container">
                    <input
                        class="email-input"
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Type your email address here…"
                        autocomplete="off"
                        >
                    <input
                        class="material-icons arrow"
                        id="inputBtn"
                        type="submit"
                        name="submit"
                        value="east"
                    >
                    <p id="errorMessage" name="JSerror"></p>
                    <p class="errMessagePHP" id="errorMessagePHP" >
                        <?php foreach($errors as $error) {
                            if(isset($_POST['submit'])){
                                if(empty($_POST['JSerror']) && !isset($_POST['JSerror'])) {
                                    echo $errors['email'];
                                }
                            }
                        } ?>
                    </p>
                </div>

                <div class="checkbox-container">
                    <input
                        type="checkbox"
                        id="checkbox"
                        name="checkbox"
                        >
                    <label for="checkbox">
                        I agree to <a href="#" class="important">terms of service</a>
                    </label>
                </div>
               
            </form>
            <hr>
            <div class="logo-container">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fab fa-youtube"></a>
            </div>

        </div>
    </div>
    
    <!--SECOND COLUMN-->
    <div class="second-column"></div>

    <script type="text/javascript" src="./js/btn.js"></script>
    <script type="text/javascript" src="./js/theme.js"></script>
</body>
</html>