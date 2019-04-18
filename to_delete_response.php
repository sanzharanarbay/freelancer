<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $r_id = 0;
        if (isset($_POST['response_id'])) {
              $r_id = $_POST['response_id'];

     $mysqli->query("DELETE FROM responses WHERE r_id=$r_id") or die($mysqli->error());

    $_SESSION['message'] = "Отклик успешно удален!!!";
    $_SESSION['msg_type'] = "danger";

    header("location:myresponses.php");
  
    }

?>