<?php
session_start();

// initializing variables
$firstname = "";
$lastname="";
$phonenumber="";
$country="";
$state="";
$city="";
$roleid=null;
$username = "";
$email    = "";
$errors = array();




$db = mysqli_connect('localhost', 'root', '', 'freelancerkz');

// REGISTER USER
if (isset($_POST['add_moderator'])) {
    // receive all input values from the form
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $roleid = mysqli_real_escape_string($db, $_POST['roleid']);
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Требуется имя пользователя"); }
    if (empty($email)) { array_push($errors, "Требуется e-mail адрес"); }
    if (empty($password_1)) { array_push($errors, "Требуется пароль"); }
   
  
    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        array_push($errors, "Имя пользователя уже существует!!!");
      }
  
      if ($user['email'] === $email) {
        array_push($errors, "E-mail уже зарегистрирован!!!");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users (u_lastname, u_firstname, email, username, u_phonenumber, u_country, u_state, u_city,  password, roleid) 
                  VALUES('$lastname','$firstname','$email','$username', '$phonenumber', '$country','$state', '$city', '$password','$roleid')";
        mysqli_query($db, $query);
        $_SESSION['success'] = "Вы добавили модератора !!!";
        header('location: moderatorlist.php');
    }
  }










?>