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
    <title>Проверка заказа</title>

  

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    
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
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminpanel.php"><img src="assets/images/logot.png" width="25" alt="Logo">&nbsp; Freelancer.kz</a>
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


<div class="container">
<br>
<br>
<?php
include 'db.php';
$vac_id = 0;
 if(isset($_GET['id'])&&is_numeric($_GET['id'])){
$query = $connection->prepare(" SELECT v.v_id, v.user_id, v.profession_id,  v.vacancy_name,v.requirements, v.price,v.v_country, v.v_state, v.v_city, v.v_statusid,  v.post_date, p.p_id, p.name, u.id, u.username, c.country_id, c.country_name, ci.city_id, ci.city_name, s.s_id, s.status
                     FROM vacancies v 
                     LEFT OUTER JOIN professions p  ON p.p_id = v.profession_id
                     LEFT OUTER JOIN users u  ON u.id = v.user_id
                     LEFT OUTER JOIN countries c  ON c.country_id = v.v_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = v.v_city
                     LEFT OUTER JOIN status s   ON s.s_id = v.v_statusid
                     WHERE v.v_id = :id LIMIT 1") or die($mysqli->error);
    $query->execute(array('id'=>$_GET['id']));
    $vacancy = $query->fetch();
}

?>
<br>
<br>
<center>
<div class="row">
      <div class="col-md-8 cards">
      <form action="to_check_vacancy.php" method="post" id="check_vacancy_id" novalidate>
                   <input type="hidden" name="v_id" value="<?php echo $vacancy['v_id']?>">
                   <input type="hidden" name="status_id"  id="v_status">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> Вакансия</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vacancy_name" value="<?php echo $vacancy['vacancy_name'];?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Выберите Сферу</label>
                      <div class="col-sm-9">                      
                      <select class="form-control" id="sindustry" name="profession_id" required>
                        <option value="<?php echo $vacancy['profession_id']?>"><?php echo $vacancy['name']?></option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Цена</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="price" value="<?php echo $vacancy['price'];?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Описание</label>
                        <div class="col-sm-9">
                            <textarea  rows = "15" class="form-control" name="requirements" required><?php echo $vacancy['requirements'];?></textarea>
                        </div>
                    </div>
                     <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Выберите страну</label>
                      <div class="col-sm-9">     
                      <select class="form-control" id="scountry" name="country" required>
                        <option><?php echo $vacancy['country_name'] ?></option>
                      </select>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Выберите город</label>
                      <div class="col-sm-9">   
                      <select class="form-control" id="scity" name="city" required>
                        <option><?php echo $vacancy['city_name'] ?></option>
                      </select>
                    </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input type="submit" class="btn btn-outline-info" name="accept_vacancy" value="Принимать" onclick="toAcceptVacancy()">
                            <input type="submit" class="btn btn-outline-danger" name="reject_vacancy" value="Отклонять" onclick="toRejectVacancy()">
                            </div>
                    </div>

                </form>
    </div> 
  </div>

 
  </center>

  </div>
         

  <script>

       function  toAcceptVacancy() {
               document.getElementById("v_status").value = 3;
               document.getElementById("check_vacancy_id").submit();
           }
           function  toRejectVacancy() {
               document.getElementById("v_status").value = 4;
               document.getElementById("check_vacancy_id").submit();
           }
       

    </script>
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
