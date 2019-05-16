<?php
session_start();

// initializing variables
$ufirstname = "";
$ulastname="";
$uphonenumber="";
$uemail    = "";
$errors = array();




$mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

// UPDATE 'USER'S DATA
if (isset($_POST['update_admin'])) {
    // receive all input values from the form
    $ulastname =$_POST['lastname'];
    $ufirstname = $_POST['firstname'];
    $uphonenumber =$_POST['phonenumber'];
    $upassword_1 = $_POST['password'];
    $upassword_2 = $_POST['password2'];
    $userid = $_POST['userid'];
  


    if ($upassword_1 != $upassword_2) {
        array_push($errors, "Пароли не совпадают!!!");
      }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $upassword = md5($upassword_1);//encrypt the password before saving in the database
  
        $mysqli->query("UPDATE users SET u_lastname='$ulastname', u_firstname='$ufirstname', u_phonenumber='$uphonenumber', password='$upassword' WHERE id=$userid") or die($mysqli->error);
       
        $_SESSION['messages'] = "Данные успешно изменены!!!";
        $_SESSION['msg_types'] = "success";
    
        header('location: adminprofile.php');
    }
  }










?>