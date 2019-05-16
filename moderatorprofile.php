<?php 
  include('to_editmoderatorprofile.php') ;

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
    <title>Профиль Модератора</title>

  

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">


    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <style type="text/css">
        	body{
            margin-top:70px;
            margin-left:300px;}
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
  .form-control{
    width:450px;
    color:#323232;
    font-size:20px;
    font-family:Arial;
  }
          </style>
  </head>
  <body>
  <?php  if (isset($_SESSION['username']) && ($_SESSION['role_id']==2)) { ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="moderatorpanel.php"><img src="assets/images/logo2.png" height="30" alt="Logo"></a>
  <input class="form-control form-control-dark w-70" type="text" placeholder="Search" aria-label="Search">&nbsp;&nbsp;&nbsp;
  <?php  if (isset($_SESSION['username'])) { ?>
    <div class="dropdown">
    <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
    <div class="dropdown-content">
    <a href="moderatorprofile.php">Профиль</a>
   <a href="orderlist.php">Список заказов</a>
   <a href="#">Статус заказов</a>
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
            <a class="nav-link" href="moderatorprofile.php">
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
$userid = $_SESSION['user_id'];
$pass = $_SESSION['password'];
$query = $connection->prepare(" SELECT u.id, u.u_lastname, u.u_firstname, u.email, u.username, 
u.u_phonenumber, u.u_country, u.u_city, u.u_state, u.password, u.roleid, r.r_id, r.r_name, c.country_id, c.country_name,
ci.city_id, ci.city_name, s.state_id, s.state_name
                     FROM users u 
                     LEFT OUTER JOIN roles r  ON r.r_id = u.roleid
                     LEFT OUTER JOIN states s  ON s.state_id = u.u_state
                     LEFT OUTER JOIN countries c  ON c.country_id = u.u_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = u.u_city
                     WHERE u.id = :users_id
                     ") or die($mysqli->error);
    $query->execute(array('users_id'=>$userid));
    $user = $query->fetch();
    

?>
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-8">
        <?php
                if (isset($_SESSION['messages'])): ?>

                <div class="alert alert-<?=$_SESSION['msg_types']?>">
                    <?php
                    echo $_SESSION['messages'];
                    unset($_SESSION['messages']);
                    ?>

                </div>

                <?php endif ?>
                <?php include('errors.php'); ?>
            </div>
        <div class="col-sm-4">
            <a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" height="230" src="https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png"></a>
            <input type="file" name="upload" id="upload"  placeholder="Выбрать файл">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Профиль</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Привелегия:</strong></span> <?php echo $user['r_name']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Логин:</strong></span><?php echo $user['username']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>ФИО:</strong></span> <?php echo $user['u_firstname']." ".$user['u_lastname']; ?></li>

            </ul>

            <div class="panel panel-default">
                <hr>
            </div>

            <ul class="list-group">
                <li class="list-group-item text-muted">Дополнительно <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Страна:</strong></span> <?php echo $user['country_name']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Регион:</strong></span> <?php echo $user['state_name']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Город:</strong></span> <?php echo $user['city_name']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Телефон:</strong></span> <?php echo $user['u_phonenumber']; ?></li>
            </ul>

           

        </div>
        <!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#settings" data-toggle="tab">Настройки</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="settings">

                    <hr>
                    
                    <form class="form" action="moderatorprofile.php" method="post" id="registrationForm">
                        <div class="form-group">
                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4>Имя</h4></label>
                                <input type="text" class="form-control" name="firstname" id="first_name"  value="<?php echo $user['u_firstname']; ?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4>Фамилия</h4></label>
                                <input type="text" class="form-control" name="lastname" id="last_name" value="<?php echo $user['u_lastname']; ?>">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>Мобильный телефон</h4></label>
                                <input type="text" class="form-control" name="phonenumber" id="phone" value="<?php echo $user['u_phonenumber']; ?>" maxlength="12">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">

                           
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password">
                                    <h4>Пароль</h4></label>
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $_SESSION['password']; ?>" minlength="8">
                                <input type="checkbox" onclick="myFunction()">Показать пароль
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password2">
                                    <h4>Повторите пароль</h4></label>
                                <input type="password" class="form-control" name="password2" id="password2" value="<?php echo $_SESSION['password']; ?>" minlength="8">
                                <input type="checkbox" onclick="myFunction2()">Показать пароль
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-md btn-success" type="submit" name="update_moderator"><i class="glyphicon glyphicon-ok-sign"></i> Сохранить</button>
                                <button class="btn btn-md btn-dark" type="reset"><i class="glyphicon glyphicon-repeat"></i> Отмена</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!--/tab-pane-->
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
<?php }else{ 
  header("location:404.php");
}
  ?>
  <script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        </body>
        
</html>
