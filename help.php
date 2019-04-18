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
        <title>Помощь</title>
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
h5{
  float:left;
}
p{
  float:left;
  color:blue;
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
      <li class="nav-item ">
        <a class="nav-link" href="vacancies.php">Заказы </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="help.php">Помощь <span class="sr-only">(current)</span></a>
      </li>
		</ul>
    <form class="form-inline">
      <input class="form-control searchbox" type="text" placeholder="Search" aria-label="Search">
    </form>
    <div class="content">
  	<!-- notification message -->
  	

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) { ?>
    	<div class="dropdown">
  <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
  <div class="dropdown-content">
  <?php if ($_SESSION['role_id']==3){?>
   <a href="#">Профиль</a>
   <a href="add_vacancy.php">Добавить заказ</a>
   <a href="myvacancies.php">Мои заказы</a>
      <a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }else if($_SESSION['role_id']==4){?>
		<a href="#">Профиль</a>
	  <a href="searchvacancy.php">Найти заказ</a>
    <a href="myresponses.php">Мои отклики</a>
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
       
    <section class="sections">
        <div class="container">
    <!-- Example row of columns -->
    <div class="text-center">
    <center>
    <br>
    <br>
    <br>
    <br>
     <h1>Часто задаваемые вопросы</h1>
     <h5> <b>1.    Является ли сайт бесплатным?</b></h5>
     <p>Сайт freelancer.kz является бесплатным. Каждый зарегистрированный пользователь имеет возможность полноценно<br>
      пользоваться сайтом. Наша философия заключается в том, чтобы давать всем равные возможности, а не искусственно <br>
      ограничивать, а потом снимать ограничения за плату.</p>
      <h5> <b>2.    При регистрации я должен указать свой e-mail, не будет ли приходить на него спам?</b></h5>
      <p>Введенный вам адрес e-mail будет использован исключительно в рамках сайта. Указанные вами публичные контатные <br>
      данные будут доступны только зарегистрированным пользователям сайта,  Ваш почтовый адрес, а также любая другая контактная <br>
       информация, не при каких обстоятельствах будут переданы третьим лицам или использованы для нецелевых почтовых рассылок.</p>
       <h5> <b> 3.    У меня есть отличная идея по улучшению сайта, сможете ли вы ее реализовать?</b></h5>
       <p>Безусловно, мы очень рады вашим идеям, ведь сайт работает для вас! Вы можете предложить свою идею — если нам она <br>
       понравится, она обязательно будет воплощена в жизнь.</p>
       <h5> <b> 4.    Я по ошибке зарегистрировался как Заказчик, но я Фрилансер. Что делать?</b></h5>
       <p>Просто напишите письмо в службу поддержки, указав ваш логин и нужный тип профиля.</p>
       <h5> <b> 5.    Я хотел бы не только работать на сервисе как фрилансер, но также и периодически размещать проекты. <br>
        Могу ли я зарегистрировать дополнительный профиль заказчика?</b></h5>
        <p>Да, вы может зарегистрировать один профиль заказчика и один профиль фрилансера. Нужно указать разные e-mail <br>
        адреса при  регистрации профилей. Или можете написать письмо в службу поддержки, указав ваш логин. Мы сможем <br>
        открыть Вам доступ для размещения проектов.  </p>
        <h5> <b> 6.    Я перестал заниматься фрилансом, как мне удалить свой профиль?</b></h5>
        <p>Напишите письмо в службу поддержки, указав ваш логин. Учтите, что с целью сделать фриланс более безопасным профили с <br>
        негативными отзывами удалению не подлежат.</p>
        <h5> <b> 7.    Насколько безопасно фрилансеру публиковать свои контактные данные?</b></h5>
        <p>Мы приложили максимум усилий, чтобы ваши контакты увидели только те люди, которые хотят предложить вам работу. <br>
        Во-первых, просмотр контактов доступен только зарегистрированным пользователям. </p>
     </center>
    </div>
    </section>


  </div> <!-- /container -->

    

 

		
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

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
