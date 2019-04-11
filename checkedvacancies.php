<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: moderator.php");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title> Проверенные заказы</title>

  

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/orderlist.css" type="text/css">
    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <style type="text/css">
        	
          .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 5px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  .dropdown {
    position: relative;
    margin-right:125px;
    display: inline-block;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  .dropdown-content a:hover {background-color: #f1f1f1}
  
  .dropdown:hover .dropdown-content {
    display: block;
  }
  
  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }
  .cards{
      position:absolute;
      top:100px;
      left:300px;
  }
 
 
          </style>
  </head>
  <body>
  <?php  if (isset($_SESSION['username']) && ($_SESSION['role_id']==2)) { ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminpanel.php"><img src="assets/images/logo2.png" height="30" alt="Logo">&nbsp; </a>
  <input class="form-control form-control-dark w-70" type="text" placeholder="Search" aria-label="Search">&nbsp;&nbsp;&nbsp;
  <?php  if (isset($_SESSION['username'])) { ?>
    <div class="dropdown">
    <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
    <div class="dropdown-content">
    <a href="#">Профиль</a>
   <a href="#">Список заказов</a>
   <a href=#">Статус заказов</a>
      <a href="index.php?logout='1'" style="color: red;">Выход</a>
      </div>
</div>
<?php } ?>
</nav>

<div class="container-fluid">
<div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="moderatorpanel.php">
              <span data-feather="home"></span>
              Панель <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Профиль
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orderlist.php">
              <span data-feather="shopping-cart"></span>
              Список заказов
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="checkedvacancies.php">
              <span data-feather="users"></span>
              Проверенные заказы
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="uncheckedvacancies.php">
              <span data-feather="bar-chart-2"></span>
              Непроверенные заказы
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Отчеты
            </a>
          </li>
        </ul>

        
      </div>
    </nav>

    
  </div>
</div>

<?php
include 'db.php';
$checked = 3;
$unchecked = 4;
 $start = 0;  $per_page = 5;
    $page_counter = 0;
    $next = $page_counter + 1;
    $previous = $page_counter - 1;
     if(isset($_GET['start'])){
     $start = $_GET['start'];
     $page_counter =  $_GET['start'];
     $start = $start *  $per_page;
     $next = $page_counter + 1;
     $previous = $page_counter - 1;
    }
$query = $connection->prepare(" SELECT v.v_id, v.user_id, v.profession_id,  v.vacancy_name,v.requirements, v.price, v.v_country, v.v_city, v.post_date, p.p_id, p.name, u.id, u.username, c.country_id, c.country_name, ci.city_id, ci.city_name, s.s_id, s.status
                     FROM vacancies v 
                     LEFT OUTER JOIN professions p  ON p.p_id = v.profession_id
                     LEFT OUTER JOIN users u  ON u.id = v.user_id
                     LEFT OUTER JOIN countries c  ON c.country_id = v.v_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = v.v_city
                     LEFT OUTER JOIN status s   ON s.s_id = v.v_statusid
                     WHERE v.v_statusid = :checked_id OR v.v_statusid = :unchecked_id
                     ORDER BY v.post_date DESC
                     LIMIT $start, $per_page") or die($mysqli->error);
    $query->execute(array('checked_id'=>$checked, 'unchecked_id'=>$unchecked));
    $vacancies = $query->fetchAll();
    $count_query = "SELECT * FROM vacancies WHERE v_statusid = '$checked' OR v_statusid = '$unchecked'";
    $query1 = $connection->prepare($count_query);
    $query1->execute();
    $count = $query1->rowCount();
     $paginations = ceil($count / $per_page);

?>

<div class="container">
<br>
<br>
<br>
<br>
<center>
<div class="row">
      <div class="col-md-8 cards">
   
    <?php
            foreach ($vacancies as $vacancy) {
                ?>
                <div class="card border-primary mb-3">
                <div class="card-header bg-transparent border-info">  <?php  echo $vacancy['vacancy_name']; ?> </div>
                  <div class="card-body">
                
                <h5>   <?php  echo $vacancy['price']. " KZT"; ?></h5>
                    <b>   <?php  echo $vacancy['name']; ?> </b>
                    <p>  <?php  echo $vacancy['country_name']; ?> , &nbsp; <?php  echo $vacancy['city_name']; ?></p>
                    <a href="checkorder.php?id=<?php echo $vacancy['v_id'] ?>" class="btn btn-outline-success btn-md">Проверить</a>
                     </div>
                     <div class="card-footer bg-transparent border-info">
                    <b>  Posted on <?php echo $vacancy['post_date'] ; ?> by <?php echo $vacancy['username'] ; ?>, <?php echo $vacancy['status'] ; ?> </b>
                     </div>
                      </div>
                     <?php
            }
            ?>
    </div> 
  </div>

  <ul class="pagination">
            <?php
                if($page_counter == 0){
                    echo "<li><a href=?start='0' class='active'>0</a></li>";
                    for($j=1; $j < $paginations; $j++) { 
                      echo "<li><a href=?start=$j>".$j."</a></li>";
                   }
                }else{
                    echo "<li><a href=?start=$previous>Previous</a></li>"; 
                    for($j=0; $j < $paginations; $j++) {
                     if($j == $page_counter) {
                        echo "<li><a href=?start=$j class='active'>".$j."</a></li>";
                     }else{
                        echo "<li><a href=?start=$j>".$j."</a></li>";
                     } 
                  }if($j != $page_counter+1)
                    echo "<li><a href=?start=$next>Next</a></li>"; 
                } 
            ?>
            </ul>
  </center>

  </div>
         
<?php }else{ 
  header("location:404.php");
}
  ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        </body>
        
</html>
