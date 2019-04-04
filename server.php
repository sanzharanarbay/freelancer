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
$ferrors = array();  

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'freelancerkz');

// REGISTER USER
if (isset($_POST['reg_cus'])) {
  // receive all input values from the form
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $roleid = mysqli_real_escape_string($db, $_POST['roleid']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Требуется имя пользователя"); }
  if (empty($email)) { array_push($errors, "Требуется e-mail адрес"); }
  if (empty($password_1)) { array_push($errors, "Требуется пароль"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Пароли не совпадают!!!");
  }

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
    $_SESSION['username'] = $username;
    $_SESSION['role_id'] = $roleid;
    $_SESSION['success'] = "Вы зашли !!!";
  	header('location: index.php');
  }

  
}


if (isset($_POST['reg_free'])) {
  // receive all input values from the form
  $flastname = mysqli_real_escape_string($db, $_POST['flastname']);
  $ffirstname = mysqli_real_escape_string($db, $_POST['ffirstname']);
  $fusername = mysqli_real_escape_string($db, $_POST['fusername']);
  $femail = mysqli_real_escape_string($db, $_POST['femail']);
  $fphonenumber = mysqli_real_escape_string($db, $_POST['fphonenumber']);
  $fcountry = mysqli_real_escape_string($db, $_POST['fcountry']);
  $fstate = mysqli_real_escape_string($db, $_POST['fstate']);
  $fcity = mysqli_real_escape_string($db, $_POST['fcity']);
  $fpassword_1 = mysqli_real_escape_string($db, $_POST['fpassword_1']);
  $fpassword_2 = mysqli_real_escape_string($db, $_POST['fpassword_2']);
  $froleid = mysqli_real_escape_string($db, $_POST['froleid']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fusername)) { array_push($ferrors, "Требуется имя пользователя"); }
  if (empty($femail)) { array_push($ferrors, "Требуется e-mail адрес"); }
  if (empty($fpassword_1)) { array_push($ferrors, "Требуется пароль"); }
  if ($fpassword_1 != $fpassword_2) {
	array_push($ferrors, "Пароли не совпадают!!!");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_querys = "SELECT * FROM users WHERE username='$fusername' OR email='$femail' LIMIT 1";
  $results = mysqli_query($db, $user_check_querys);
  $users = mysqli_fetch_assoc($results);
  
  if ($users) { // if user exists
    if ($users['username'] === $fusername) {
      array_push($ferrors, "Имя пользователя уже существует!!!");
    }

    if ($users['email'] === $femail) {
      array_push($ferrors, "E-mail уже зарегистрирован!!!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($ferrors) == 0) {
  	$fpassword = md5($fpassword_1);//encrypt the password before saving in the database

  	$fquery = "INSERT INTO users (u_lastname, u_firstname, email, username, u_phonenumber, u_country, u_state, u_city,  password, roleid) 
  			  VALUES('$flastname','$ffirstname','$femail','$fusername', '$fphonenumber', '$fcountry','$fstate', '$fcity', '$fpassword','$froleid')";
  	mysqli_query($db, $fquery);
    $_SESSION['username'] = $fusername;
    $_SESSION['role_id'] = $froleid;
  	$_SESSION['success'] = "Вы зашли !!!";
  	header('location: index.php');
  }
}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Требуется имя пользователя!!!");
  }
  if (empty($password)) {
  	array_push($errors, "Требуется пароль!!!");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
    
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)){
  	  $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['role_id'] = $row['roleid'];
  	  $_SESSION['success'] = "Вы успешно зашли!!!";
  	  header('location: index.php');
    }
  	}else {
  		array_push($errors, "Неверное имя пользователя или пароль!!!");
  	}
  }
}

// LOGIN ADMIN
if (isset($_POST['login_admin'])) {
  $role = 1;
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Требуется имя пользователя!!!");
  }
  if (empty($password)) {
  	array_push($errors, "Требуется пароль!!!");
  }
  
  if (count($errors) == 0) {
  	$password = md5($password);
    
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND roleid='$role'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)){
  	  $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['role_id'] = $row['roleid'];
  	  $_SESSION['success'] = "Вы успешно зашли!!!";
  	  header('location: adminpanel.php');
    }
  	}else {
  		array_push($errors, "Неверное имя пользователя или пароль!!!");
  	}
  }
}

// LOGIN MODERATOR
if (isset($_POST['login_moderator'])) {
  $rol = 2;
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Требуется имя пользователя!!!");
  }
  if (empty($password)) {
  	array_push($errors, "Требуется пароль!!!");
  }
  
  if (count($errors) == 0) {
  	$password = md5($password);
    
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND roleid='$rol'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)){
  	  $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['role_id'] = $row['roleid'];
  	  $_SESSION['success'] = "Вы успешно зашли!!!";
  	  header('location: moderatorpanel.php');
    }
  	}else {
  		array_push($errors, "Неверное имя пользователя или пароль!!!");
  	}
  }
}


?>