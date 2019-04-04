<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: admin.php");
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
    <title>Список модераторов</title>

  

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/moderatorlist.css" type="text/css">

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logot.png" type="image/x-icon">
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
  .mytable{
    margin-left:120px;
  }
  .myalert{
    margin-left:300px;
    width:500px;
  }
          </style>
  </head>
  <body>
  <?php  if (isset($_SESSION['username']) && ($_SESSION['role_id']==1)) { ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminpanel.php"><img src="assets/images/logot.png" width="25" alt="Logo">&nbsp; Freelancer.kz</a>
  <input class="form-control form-control-dark w-70" type="text" placeholder="Search" aria-label="Search">&nbsp;&nbsp;&nbsp;
  <?php  if (isset($_SESSION['username'])) { ?>
    <div class="dropdown">
    <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
    <div class="dropdown-content">
    <a href="#">Профиль</a>
   <a href="#">Добавить модератора</a>
   <a href=#">Список Модераторов</a>
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
            <a class="nav-link active" href="adminpanel.php">
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
            <a class="nav-link" href="addmoderator.php">
              <span data-feather="shopping-cart"></span>
              Добавить модератора
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addmoderator.php">
              <span data-feather="users"></span>
              Список модераторов
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reports.php">
              <span data-feather="bar-chart-2"></span>
              Отчеты
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        
      </div>
    </nav>

    
  </div>
</div>

<div class="container">
<br>
<br>
<br>
<br>
<?php
if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?> myalert">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>

</div>

<?php endif ?>
<?php
include 'db.php';
$rolei = 2;
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
$query = $connection->prepare(" SELECT  u.id, u.u_lastname, u.u_firstname, u.email,  u.username, u.u_phonenumber, u.u_country, u.u_city,  c.country_id, c.country_name, ci.city_id, ci.city_name, r.r_id, r.r_name
                     FROM users u 
                     LEFT OUTER JOIN countries c  ON c.country_id = u.u_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = u.u_city
                     LEFT OUTER JOIN roles r   ON r.r_id = u.roleid
                     WHERE u.roleid = :role_id
                     ORDER BY u.u_lastname ASC
                     LIMIT $start, $per_page") or die($mysqli->error);
    $query->execute(array('role_id'=>$rolei));
    $moderators = $query->fetchAll();
    $count_query = "SELECT * FROM users WHERE roleid = '$rolei'";
    $query1 = $connection->prepare($count_query);
    $query1->execute();
    $count = $query1->rowCount();
     $paginations = ceil($count / $per_page);

?>
<center>
<table class="table mytable">
  <thead>
    <tr>
      <th scope="col">Фамилия</th>
      <th scope="col">Имя</th>
      <th scope="col">E-mail</th>
      <th scope="col">Имя пользователя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Телефон</th>
      <th scope="col">Страна</th>
      <th scope="col">Роль</th>
      <th scope="col">Удалить</th>
    </tr>
  </thead>
  <tbody>
  <?php
            foreach ($moderators as $moderator) {
                ?>
                <tr>
      <th scope="row"> <?php  echo $moderator['u_lastname']; ?></th>
      <td> <?php  echo $moderator['u_firstname']; ?></td>
      <td> <?php  echo $moderator['email']; ?></td>
      <td> <?php  echo $moderator['username']; ?></td>
      <td> <?php  echo $moderator['u_phonenumber']; ?></td>
      <td> <?php  echo $moderator['country_name']; ?></td>
      <td> <?php  echo $moderator['city_name']; ?></td>
      <td> <?php  echo $moderator['r_name']; ?></td>
      <td>
        <form action="to_delete_moderator.php" method="post" id="deletem">
          <input type="hidden" name="m_id" value="<?php echo $moderator['id']?>">
        <input type="submit" class="btn btn-outline-danger"  value="Удалить" onclick="return confirmDelete();"> 
            </form>
      </td>
    </tr>
                     <?php
            }
            ?>
    
  </tbody>
</table>

<br>
<br>
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
<script>

function confirmDelete() {

  if (confirm("Вы подтверждаете удаление?")) {
      return true;
    }else{
      return false;
    }
}

</script>

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
