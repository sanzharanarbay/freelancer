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
        <title>Мои отклики</title>
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
    <?php  if (isset($_SESSION['username'])  && ($_SESSION['role_id']== 4)) { ?>
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
      <a href="myresponses.php">Мои отклики</a>
		<a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }?>
  </div>
</div>

	
    	
	</div>
   
	
  </div>
</nav>

        <!--Home page style-->
       

        <!-- Sections -->
        <section id="vacancies" class="sections">
        <?php
include 'db.php';
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
$query = $connection->prepare("SELECT r.r_id, r.r_vacid, r.r_freeid, r.r_custid, r.r_statusid,r.r_respdate,
 v.v_id, v.vacancy_name, v.user_id, u.id, u.username, u.u_lastname, u.u_firstname, u.u_phonenumber ,
  u.email,  st.st_id, st.st_status
                     FROM responses r
                     LEFT OUTER JOIN  vacancies v ON v.v_id = r.r_vacid 
                     LEFT OUTER JOIN users u ON  u.id = r.r_custid 
                     LEFT OUTER JOIN statuses st ON st.st_id = r.r_statusid
                     WHERE r.r_freeid = :freelancer_id
                     ORDER BY r.r_respdate DESC
                     LIMIT $start, $per_page") or die($mysqli->error);
    $query->execute(array('freelancer_id'=>$_SESSION['user_id']));
    $freeid = $_SESSION['user_id'];
    $responses = $query->fetchAll();
    $count_query = "SELECT * FROM responses WHERE r_freeid = '$freeid'";
    $query1 = $connection->prepare($count_query);
    $query1->execute();
    $count = $query1->rowCount();
     $paginations = ceil($count / $per_page);

?>

  <div class="container">
    <!-- Example row of columns -->
    <?php
if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?> myalert">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>

</div>

<?php endif ?>
    <center>
<table class="table mytable">
  <thead>
    <tr>
      <th scope="col">Вакансия</th>
      <th scope="col">Заказщик</th>
      <th scope="col">Дата отклика</th>
      <th scope="col">Статус</th>
      <th scope="col">Контакты</th>
      <th scope="col">О вакансии</th>
      <th scope="col">Отменить</th>
    </tr>
  </thead>
  <tbody>
  <br>
  <?php
            foreach ($responses as $response) {
                ?>
                <tr>
      <th scope="row"> <?php  echo $response['vacancy_name']; ?></th>
      <td> <?php  echo $response['u_firstname']. " ".$response['u_lastname']."<br>"."<b>".$response['username']."</b>" ?></td>
      <td> <?php  echo $response['r_respdate']; ?></td>
      <td> <?php  echo $response['st_status']; ?></td>
      <td> <?php  echo $response['u_phonenumber']. "<br>". $response['email']; ?></td>
      <td> <a href="readmore.php?id=<?php echo $response['v_id'] ?>" class="btn btn-outline-info btn-md"> О вакансии</a> </td>
      <td>
        <form action="to_delete_response.php" method="post" id="deletem">
          <input type="hidden" name="response_id" value="<?php echo $response['r_id']?>">
        <input type="submit" class="btn btn-outline-danger"  value="Отменить" onclick="return confirmDelete();"> 
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
</center>
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
    <?php }else{ 
  header("location:404.php");
}
  ?>
  

		
		
	  
		
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

        <script>

        function confirmDelete() {

          if (confirm("Вы подтверждаете удаление?")) {
              return true;
            }else{
              return false;
            }
        }

</script>
        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
