<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $v_id = 0;
    $user_id=0;
    $profession_id=0;
    $vacancy_name = "";
    $requirements = "";
    $price=0;
    $update = false;
    $loc = "";
        if (isset($_POST['save_vacancy'])) {
              $v_id = $_POST['v_id'];
              $profession_id = $_POST['profession_id'];
              $vacancy_name = $_POST['vacancy_name'];
             $requirements = $_POST['requirements'];
             $price = $_POST['price'];

     $mysqli->query("UPDATE vacancies SET profession_id='$profession_id', vacancy_name='$vacancy_name', requirements='$requirements', price='$price'  WHERE v_id=$v_id") or die($mysqli->error);    
  
    $_SESSION['message'] = "Заказ успешно изменен!!!";
    $_SESSION['msg_type'] = "warning";
    

    header('location:myvacancies.php');
    }
    

?>