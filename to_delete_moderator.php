<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $userid = 0;
        if (isset($_POST['m_id'])) {
              $userid = $_POST['m_id'];

     $mysqli->query("DELETE FROM users WHERE id = $userid") or die($mysqli->error());

    $_SESSION['message'] = "Модератор успешно удален!!!";
    $_SESSION['msg_type'] = "danger";

    header("location:moderatorlist.php");
  
    }

?>