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
        <title>Мои заказы</title>
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
        <link rel="stylesheet" href="assets/css/pagination.css" type="text/css">

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
                .pagination{
                  margin-left:100px;
                }
                #itemCount {
                  padding: 0;
                  text-align: center;
                }
                #itemCount p{
                  margin: 0 0 0 10px;
                  float: right;
                  width:20px;
                  height:20px;
                  background: #FFDD40;
                  border-radius: 50%;
                  color: #000;

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
  	

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) { ?>
    	<div class="dropdown">
  <button class="btn btn-outline-success"><?php echo $_SESSION['username']; ?></button>
  <div class="dropdown-content">
  <?php if ($_SESSION['role_id']==3){?>
   <a href="profile.php">Профиль</a>
   <a href="add_vacancy.php">Новый заказ</a>
   <a href="myvacancies.php">Мои заказы</a>
      <a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }else if($_SESSION['role_id']==4){?>
		<a href="profile.php">Профиль</a>
	  <a href="#">Найти заказ</a>
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
       

        <!-- Sections -->
        
<?php
include 'db.php';
$vac_id = 0;
$start = 0;  $per_page = 4;
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
if(isset($_SESSION['user_id'])){
$query = $connection->prepare(" SELECT v.v_id, v.user_id, v.profession_id,  v.vacancy_name,v.requirements, v.price, v.v_country, v.v_city, v.v_statusid, v.post_date, p.p_id, p.name, u.id, u.username, c.country_id, c.country_name, ci.city_id, ci.city_name, s.s_id, s.status
                     FROM vacancies v 
                     LEFT OUTER JOIN professions p  ON p.p_id = v.profession_id
                     LEFT OUTER JOIN users u  ON u.id = v.user_id
                     LEFT OUTER JOIN countries c  ON c.country_id = v.v_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = v.v_city
                     LEFT OUTER JOIN status s   ON s.s_id = v.v_statusid
                     WHERE v.user_id = :user_id
                     ORDER BY v.post_date DESC
                     LIMIT $start, $per_page") or die($mysqli->error);
    $query->execute(array('user_id'=>$_SESSION['user_id']));
    $vacancies = $query->fetchAll();
    $userid = $_SESSION['user_id'];
    $count_query = "SELECT * FROM vacancies WHERE user_id = '$userid'";
    $query1 = $connection->prepare($count_query);
    $query1->execute();
    $count = $query1->rowCount();
     $paginations = ceil($count / $per_page);
}

?>
  <?php if ($_SESSION['role_id']==3){ ?>
  <section id="vacancies" class="sections">
  	
  <div class="container">
    <!-- Example row of columns -->
    <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <br> <br>
               <?php
if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>

</div>

<?php endif ?>
 <?php
            foreach ($vacancies as $vacancy) {
                ?>
                <?php 
                    $vacan_id = $vacancy['v_id'];
                    $nquery = "SELECT * FROM responses WHERE r_vacid = '$vacan_id'";
                    $query2 = $connection->prepare($nquery);
                    $query2->execute();
                    $ncount = $query2->rowCount();
                    ?>  
                <div class="card mb-4">
                  <div class="card-body">
                <h4>   <?php  echo $vacancy['vacancy_name']; ?></h4>
                <h5>   <?php  echo $vacancy['price']. " KZT"; ?></h5>
                    <b>   <?php  echo $vacancy['name']; ?> </b>
                    <p>  <?php  echo $vacancy['country_name']; ?>, &nbsp; <?php  echo $vacancy['city_name']; ?> </p>
                    <p>  <?php  echo $vacancy['status']; ?></p>
                    <a href="editvacancy.php?id=<?php echo $vacancy['v_id'] ?>" class="btn btn-outline-primary btn-sm">Изменить заказ</a>
                    &nbsp; &nbsp; &nbsp; 
                    <a href="custresponse.php?id=<?php echo $vacancy['v_id'] ?>" class="btn btn-outline-danger btn-sm">Отклики на заказов
                     <span id="itemCount"><p><?php echo $ncount; ?></p></span>
                    </a>
                   
                     </div>
                     <div class="card-footer text-muted">
                    <b>  Posted on <?php echo $vacancy['post_date'] ; ?> by <?php echo $vacancy['username'] ; ?></b>
                     </div>
                      </div>
                     <?php
            }
            ?>
                             </div>
                                      </div>
        <!-- /.row -->
                    
        <center>
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

  </div> <!-- /container -->
  
 </section>
    <hr>
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

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
