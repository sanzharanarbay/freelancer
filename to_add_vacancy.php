<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $id = 0;
    $user_id=0;
    $profession_id=0;
    $vacancy_name = "";
    $requirements = "";
    $price=0;
    $country="";
    $state="";
    $city="";
    $status_id="";
    $update = false;
    $loc = "";
        if (isset($_POST['add_vacancy'])) {
             $user_id = $_POST['user_id'];
             $status_id = $_POST['status_id'];
              $profession_id = $_POST['profession_id'];
              $vacancy_name = $_POST['vacancy_name'];
             $requirements = $_POST['requirements'];
             $price = $_POST['price'];
             $country = $_POST['country'];
             $state = $_POST['state'];
             $city = $_POST['city'];

             $mysqli->query("INSERT INTO vacancies (v_id, user_id, profession_id, vacancy_name, requirements, price, v_country, v_state, v_city, v_statusid) VALUES (NULL,'$user_id','$profession_id','$vacancy_name', '$requirements', '$price', '$country', '$state', '$city', '$status_id')") or die($mysqli->error);

    $_SESSION['message'] = "Заказ успешно сохранен!!!";
    $_SESSION['msg_type'] = "success";
     
    $loc="myvacancies.php?id=".$mysqli->insert_id."&success=1";
    header("location:$loc");
    }

?>