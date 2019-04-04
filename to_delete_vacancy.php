<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $v_id = 0;
        if (isset($_POST['v_id'])) {
              $v_id = $_POST['v_id'];

     $mysqli->query("DELETE FROM vacancies WHERE v_id=$v_id") or die($mysqli->error());

    $_SESSION['message'] = "Заказ успешно удален!!!";
    $_SESSION['msg_type'] = "danger";

    header("location:myvacancies.php");
  
    }

?>