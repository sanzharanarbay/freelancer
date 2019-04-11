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
        <title>Freelancer.kz</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="vacancies.php">Заказы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="help.php">Помощь</a>
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
        <header class="home-bg">
		<div class="overlay-img">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="header-details">
							<h1>intelligence<br> is nothing without ambition<i class="fa fa-circle"></i></h1>
							<p>We’re small but impressive creative agency.</p>
							<button class="btn btn-default">Read More</button>
						</div>
					</div>
					

				</div>
			</div>
		</div>	
        </header>

        <!-- Sections -->
        <section id="promotion-area" class="sections">
            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="promotion">
						
						<h1>Peace<br> of Mind<i class="fa fa-circle"></i></h1>
						<p>You’re safe with us. The privacy and security of your financial information is our top priority.</p>
						<a href="#"><h4>more<span><i class="fa fa-long-arrow-right"></i></span></h4></a>
						
						</div>
					</div>
					
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="promotion">
						
						<h1>Free<br>Actually free<i class="fa fa-circle"></i></h1>
						<p>You’re safe with us. The privacy and security of your financial information is our top priority.</p>
						<a href="#"><h4>more<span><i class="fa fa-long-arrow-right"></i></span></h4></a>
						
						</div>
					</div>
					
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="promotion">
						
						<h1>Simple<br> payments<i class="fa fa-circle"></i></h1>
						<p>You’re safe with us. The privacy and security of your financial information is our top priority.</p>
						<a href="#"><h4>more<span><i class="fa fa-long-arrow-right"></i></span></h4></a>
						
						</div>
					</div>

                </div>
            </div> <!-- /container -->       
        </section>
		
		
		<section id="portfolio-area" class="sections">
            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
					<div class="col-sm-6 col-sm-12 col-xs-12">
						<div class="portfolio">
							<img src="assets/images/computer.png" alt="" />
						</div>
					</div>
					
					<div class="col-sm-5 col-sm-12 col-xs-12">
						<div class="portfolio">
						
						<div class="item">
						<h1>Portfolio<i class="fa fa-circle"></i></h1>
						<h5>We are small, but strong team</h5>
						<p>The same debit card you use to buy coffee lets deposit money straight to your bank account.</p>
						<p>You’re safe with us. The privacy and security of your financial information is our top priority.</p>
						<a href="#"><h4>more<span><i class="fa fa-long-arrow-right"></i></span></h4></a>
						</div>
						
						</div>
					</div>

                </div>
            </div> <!-- /container -->       
        </section>
		
		
		<section id="our-team" class="sections">
            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
						<div class="team-heading">
							<h1>Our Team<i class="fa fa-circle"></i></h1>
							<p>They are big but still friendly.</p>
						</div>
				
				<div class="team-member">
					
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="team">
							<img src="assets/images/man1.png" alt="" />
							<div class="team-info">
								<h2>Joey</h2>
								<h5>Web Developer</h5>
								<p>Coffee lover.  Always on bike. iPhone fan.</p>
							</div>
						</div>	
					</div>
					
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="team">
							<img src="assets/images/man2.png" alt="" />
							<div class="team-info">
								<h2>Matt</h2>
								<h5>Web Designer</h5>
								<p>Coffee lover.  Always on bike. iPhone fan.</p>
							</div>
						</div>	
					</div>
					
					<div class="col-sm-4 col-sm-12 col-xs-12">
						<div class="team">
							<img src="assets/images/man3.png" alt="" />
							<div class="team-info">
								<h2>Mike</h2>
								<h5>Copywriter</h5>
								<p>Coffee lover.  Always on bike. iPhone fan.</p>
							</div>
						</div>	
					</div>
					
					<div class="team-more">
						<a href="#"><h4>more<span><i class="fa fa-long-arrow-right"></i></span></h4></a>
					</div>
					
				</div>	
					
				</div>
                
            </div> <!-- /container -->       
        </section>
		
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
