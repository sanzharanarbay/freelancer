<?php 
include('backend.php'); 

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
    <title>Добавить Модератора</title>

  

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">


    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <script src="assets/js/jquery.min.js"></script>
    
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

.addmoderator{
    width:300px;
}

          </style>
          <script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Выберите регион</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Выберите страну</option>');
            $('#city').html('<option value="">Выберите регион</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Выберите регион</option>'); 
        }
    });
});
</script>
  </head>
  <body ng-app="myApp">
  <?php  if (isset($_SESSION['username']) && ($_SESSION['role_id']==1)) { ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminpanel.php"><img src="assets/images/logo2.png" height="30" alt="Logo"></a>
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
            <a class="nav-link" href="moderatorlist.php">
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
<center>
<form  method="post" action="addmoderator.php">
<?php include('errors.php'); ?>
<div class="form-group">
<label for="vname">Фамилия</label>
<input type="text" class="form-control addmoderator" id="vname" name="lastname" placeholder="Фамилия" required>
</div>
<div class="form-group">
<label for="vname">Имя</label>
<input type="text" class="form-control addmoderator" id="vname" name="firstname" placeholder="Имя" required>
</div>
<div class="form-group">
<label for="vname">Email</label>
<input type="email" class="form-control addmoderator" id="vname" name="email" placeholder="E-mail" required>
</div>
<div class="form-group">
<label for="vname">Имя пользователя</label>
<input type="text" class="form-control addmoderator" id="vname" name="username" placeholder="Имя пользователя" required>
</div>
<div class="form-group">
<label for="vname">Мобильный телефон</label>
<input type="text" class="form-control addmoderator" id="vname" name="phonenumber" placeholder="1234567890" maxlength="12" required>
</div>
<?php
    //Include database configuration file
    include('config.php');
    
    //Get all country data
    $query = "SELECT * FROM countries  ORDER BY country_name ASC";
    $run_query = mysqli_query($con, $query);
    //Count total number of rows
	$count = mysqli_num_rows($run_query);
    
    ?>

          <div class="form-group">
          <label for="sindustry">Выберите страну</label>
          <select  class="form-control addmoderator"  name="country" id="country" required autocomplete="off" >
        <option value="">Выберите страну</option>
        <?php
        if($count > 0){
            while($row = mysqli_fetch_array($run_query)){
				$country_id=$row['country_id'];
				$country_name=$row['country_name'];
                echo "<option value='$country_id'>$country_name</option>";
            }
        }else{
            echo '<option value="">Страна не доступна</option>';
        }
        ?>
    </select><br><br>
    <label for="sindustry">Выберите регион</label>
    <select class="form-control addmoderator" name="state" id="state" required autocomplete="off">
        <option value="">Выберите страну</option>
    </select>
	<br><br>
  <label for="sindustry">Выберите город</label>
    <select class="form-control addmoderator" name="city" id="city" required autocomplete="off">
        <option value="">Выберите регион</option>
    </select>
    </div>
    <div class="form-group">
<label for="vname"> Пароль</label>
<input type="password" class="form-control addmoderator" id="vname" name="password" placeholder="Пароль" minlength="8" required>
</div>
<input type="hidden" name="roleid" value="2">
<button type="submit" name="add_moderator" class="btn btn-outline-primary"/>Добавить Модератора</button><br>

</form>
      </center>
<br>
<br>
<br>
<br>


</div>
<?php }else{ 
  header("location:404.php");
}
  ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="assets/js/dashboard.js"></script>
        </body>
        
</html>
