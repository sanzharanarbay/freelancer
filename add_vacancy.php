<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Добавить заказ</title>
        <meta name="description" content="">
        <meta name="viewport" content="initial-scale=1">
        <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

        <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css">
        <!--        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">-->


        <!--For Plugins external css-->
        <link rel="stylesheet" href="assets/css/plugins.css" />
        <link rel="stylesheet" href="assets/css/opensans-web-font.css" />
        <link rel="stylesheet" href="assets/css/montserrat-web-font.css" />

		<!--For font-awesome css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
		
        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" type="text/css">

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
  <style type="text/css">

select {
    
 width: 300px;
    
}
.my-select {
    background-color: #efefef;
    color: #323232;
    border: 0 none;
    border-radius: 20px;
    padding: 6px 20px;
    opacity:0.79;
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
  display: inline-block;
}

.dropdown-content {
	right: 0;
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
.searchbox{
	height:35px;
	margin-right:20px;
}
.navbar-nav .mr-auto{
padding-top:0;
margin-top:0;
}
        </style>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
        <div class='preloader'><div class='loaded'>&nbsp;</div></div>
         <nav class="navbar navbar-expand-md  fixed-top mainmenu">
  <a class="navbar-brand" href="index.php"><img src="assets/images/logo2.png" height="30" alt="Logo"> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Главная </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="vacancies.php">Заказы <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="help.php">Помощь</a>
      </li>
		</ul>
    <form class="form-inline">
      <input class="form-control searchbox" type="text" placeholder="Search" aria-label="Search">
    </form>
    <div class="content">
  	

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) { ?>
    	<div class="dropdown">
  <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
  <div class="dropdown-content">
  <?php if ($_SESSION['role_id']==3){?>
   <a href="profile.php">Профиль</a>
   <a href="add_vacancy.php">Добавить заказ</a>
   <a href="myvacancies.php">Мои заказы</a>
      <a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }else if($_SESSION['role_id']==4){?>
		<a href="profile.php">Профиль</a>
	  <a href="searchvacancy.php">Найти заказ</a>
		<a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }?>
  </div>
</div>
    <?php }else{  ?>

    	<?php ?>

			<a class="btn btn-outline-danger nav-link" href="login.php">Вход</a>
    	 <?php  } ?>
	</div>
   
	
  </div>
</nav>

        <!--Home page style-->
    <?php if ($_SESSION['role_id']==3){ ?>
        <!-- Sections -->
       <section id="newvacancy" class="sections">
       	
       	<div class="container">
         	<form action="to_add_vacancy.php" method="post">
  <div class="form-group">
    <label for="vname">Задания</label>
    <input type="text" class="form-control" id="vname" name="vacancy_name" placeholder="Задания" required>
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
          <select  class="custom-select my-select"  name="country" id="country" required autocomplete="off" >
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
    <select class="custom-select my-select" name="state" id="state" required autocomplete="off">
        <option value="">Выберите страну</option>
    </select>
	<br><br>
  <label for="sindustry">Выберите город</label>
    <select class="custom-select my-select" name="city" id="city" required autocomplete="off">
        <option value="">Выберите регион</option>
    </select>
    </div>
  <div class="form-group">
    <label for="sindustry">Выберите сферу</label>
    <select class="form-control" id="sindustry" name="profession_id" required>
      <option value="1">Программирование</option>
      <option value="2">Маркетинг & Реклама</option>
      <option value="3">Дизайн</option>
      <option value="4">Оптимизация(SEO)</option>
      <option value="5">Тексты</option>
       <option value="6">Переводы</option>
      <option value="7">Архитектура и Инжиниринг</option>
      <option value="8">Аудио/Фото/Видео</option>
      <option value="9">Юридические услуги</option>
      <option value="10">Образование</option>
      <option value="11">Мобильные приложения</option>
      <option value="12">Веб разработка</option>
    </select>
  </div>
  <div class="form-group">
    <label for="vreq">Описание</label>
    <textarea class="form-control" id="vreq" name="requirements" rows="15" required=""></textarea>
  </div>
  <div class="form-group">
    <label for="vprice">Цена</label>
    <input type="number" class="form-control" id="vname" name="price" placeholder="10000 KZT" required>
    <input type="hidden" class="form-control" id="vid" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
    <input type="hidden" class="form-control"  name="status_id" value="1">
  </div>
  
  <button type="submit" class="btn btn-outline-primary" name="add_vacancy">Разместить заказ</button>
</form>
           
       	</div>
       </section>
       <?php }else{ ?>
      <section id="vacancy" class="sections">
      <div class="container">
      <br>
      <br>
    <h1> Error! You don't have access to this page!!!!  </h1> 

  </div>
    </section>
    <?php } ?>
		<div class="scroll-top">
		
			<div class="scrollup">
				<i class="fa fa-angle-double-up"></i>
			</div>
			
		</div>
	
        <!--Footer-->
        <footer>
            <div class="container">
			<hr>
            	<div class="row">
				
            		<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="social-network">
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-instagram"></i></a>
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
					
            		<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="copyright">
							<p>© 2019 freelancer.kz - All Right Reserved</p>
						</div>
					</div>
					
            	</div>
            </div>
        </footer>


        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script  src="assets/js/signin.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
