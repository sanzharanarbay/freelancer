<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','freelancerkz') or die(mysqli_error($mysqli));

    // initialize variables
    $vac_id = 0;
    $free_id = 0;
    $status_id = 0;
    
        if (isset($_POST['accept_vacancy'])) {
              $vac_id = $_POST['vac_id'];
              $status_id = $_POST['status_id'];
              $free_id = $_POST['free_id'];
     
              $mysqli->query("UPDATE responses SET r_statusid='$status_id' WHERE r_vacid=$vac_id AND r_freeid=$free_id") or die($mysqli->error);    
  
              $_SESSION['message'] = "Статус отклика изменен !!!";
              $_SESSION['msg_type'] = "success";
              
          
              header('location:myvacancies.php');
              

             
     
    }else if (isset($_POST['reject_vacancy'])) {
        $vac_id = $_POST['vac_id'];
        $status_id = $_POST['status_id'];
        $free_id = $_POST['free_id'];
       
           
        $mysqli->query("UPDATE responses SET r_statusid='$status_id' WHERE r_vacid=$vac_id AND r_freeid=$free_id") or die($mysqli->error);    
  
        $_SESSION['message'] = "Статус отклика изменен !!!";
        $_SESSION['msg_type'] = "danger";
        
    
        header('location:myvacancies.php');

}
    

?>