<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $v_id = 0;
    $status_id = 0;
    $vacancy_name = "";
    $requirements = "";
    $price=0;
        if (isset($_POST['accept_vacancy'])) {
              $v_id = $_POST['v_id'];
              $status_id = $_POST['status_id'];
              $vacancy_name = $_POST['vacancy_name'];
             $requirements = $_POST['requirements'];
             $price = $_POST['price'];

             $mysqli->query("UPDATE vacancies SET v_statusid='$status_id', vacancy_name='$vacancy_name', requirements='$requirements', price='$price'  WHERE v_id=$v_id") or die($mysqli->error);
             header('location:orderlist.php');  
     
    }else if (isset($_POST['reject_vacancy'])) {
        $v_id = $_POST['v_id'];
        $status_id = $_POST['status_id'];
        $vacancy_name = $_POST['vacancy_name'];
       $requirements = $_POST['requirements'];
       $price = $_POST['price'];

       $mysqli->query("UPDATE vacancies SET v_statusid='$status_id', vacancy_name='$vacancy_name', requirements='$requirements', price='$price'  WHERE v_id=$v_id") or die($mysqli->error);
       header('location:orderlist.php'); 
     

}
    

?>