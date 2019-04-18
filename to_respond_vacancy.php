<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));
    $db = mysqli_connect('localhost', 'root', '', 'freelancerkz');

    // initialize variables
    $vac_id = 0;
    $free_id=0;
    $cust_id=0;
    $status_id=0;
    $errors = array();
    
        if (isset($_POST['respond_vacancy'])) {
             $cust_id = $_POST['customer_id'];
             $vac_id = $_POST['vacancy_id'];
              $free_id = $_POST['freelancer_id'];
              $status_id = 1;
            
   
              $resp_check_query = "SELECT * FROM responses WHERE r_vacid='$vac_id' AND r_freeid='$free_id' LIMIT 1";
              $result = mysqli_query($db, $resp_check_query);
              $resp = mysqli_fetch_assoc($result);


              if ($resp) { // if response exists
                if (($resp['r_vacid'] == $vac_id) && ($resp['r_freeid'] == $free_id)) {
                  array_push($errors, "Вы уже откликнулись на эту вакансию!!!");
                  header("location:405.php");
                }
              }


              if (count($errors) == 0) {
             $mysqli->query("INSERT INTO responses (r_id, r_vacid, r_freeid, r_custid, r_statusid) VALUES (NULL,'$vac_id','$free_id','$cust_id','$status_id')") or die($mysqli->error);

    $_SESSION['message'] = "Отклик успешно доставлен!!!";
    $_SESSION['msg_type'] = "success";
     
    header("location:myresponses.php");
    }
}

?>