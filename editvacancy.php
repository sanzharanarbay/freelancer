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
        <title>Изменить заказ</title>
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
   <a href="add_vacancy.php">Новый заказ</a>
   <a href="myvacancies.php">Мои заказы</a>
      <a href="index.php?logout='1'" style="color: red;">Выход</a>
	<?php }else if($_SESSION['role_id']==4){?>
		<a href="#">Профиль</a>
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
 if(isset($_GET['id'])&&is_numeric($_GET['id'])){
$query = $connection->prepare(" SELECT v.v_id, v.user_id, v.profession_id,  v.vacancy_name,v.requirements, v.price,v.v_country, v.v_state, v.v_city, v.v_statusid,  v.post_date, p.p_id, p.name, u.id, u.username, c.country_id, c.country_name, ci.city_id, ci.city_name, s.s_id, s.status
                     FROM vacancies v 
                     LEFT OUTER JOIN professions p  ON p.p_id = v.profession_id
                     LEFT OUTER JOIN users u  ON u.id = v.user_id
                     LEFT OUTER JOIN countries c  ON c.country_id = v.v_country
                     LEFT OUTER JOIN cities ci  ON ci.city_id = v.v_city
                     LEFT OUTER JOIN status s   ON s.s_id = v.v_statusid
                     WHERE v.user_id = :user_id AND v.v_id = :id LIMIT 1") or die($mysqli->error);
    $query->execute(array('id'=>$_GET['id'], 'user_id'=>$_SESSION['user_id']));
    $vacancy = $query->fetch();
}

?>
 <?php if ($_SESSION['role_id']==3){ ?>
  <section id="vacancies" class="sections">
  	
  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
   <div class="col-md-8">
            <!-- Blog Entries Column -->
            <br>
           
<?php

    if(isset($vacancy)&&$vacancy!=null){

        ?>
<form action="to_save_vacancy.php" method="post" id="edit_vacancy_id" novalidate>
                   <input type="hidden" name="v_id" value="<?php echo $vacancy['v_id']?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> Вакансия</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vacancy_name" value="<?php echo $vacancy['vacancy_name'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="sindustry">Выберите Сферу</label>
                      <select class="form-control" id="sindustry" name="profession_id" required>
                        <option value="<?php echo $vacancy['profession_id']?>"><?php echo $vacancy['name']?></option>
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
                     <div class="form-group">
                      <label for="scity">Выберите страну</label>
                      <select class="form-control" id="scountry" name="country" required>
                        <option><?php echo $vacancy['country_name'] ?></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="scity">Выберите город</label>
                      <select class="form-control" id="scity" name="city" required>
                        <option><?php echo $vacancy['city_name'] ?></option>
                      </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <br>
                             <?php
                    if($vacancy['id']==$_SESSION['user_id']) {?>
                            <input type="submit" class="btn btn-primary" name="save_vacancy" value="Сохранить заказ">
                            <input type="button" class="btn btn-danger" name="delete_vacancy" value="Удалить заказ" onclick="toDeleteVacancy()">
                             
                    
                        
                <?php
                }else{

                echo  "<h1> 404 VACANCY NOT FOUND!!!   </h1>";

                }
                ?>
                        </div>
                    </div>

                </form>




        <?php
    }else{

        echo  "<h1> ACCESS DENIED!!!   </h1>";

    }
    ?>
    </div>
    </div>
        <!-- /.row -->
                    
   

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
        <script>

       function  toDeleteVacancy() {
           var check = confirm("Are you sure?");

           if (check) {

               document.getElementById("edit_vacancy_id").action = "to_delete_vacancy.php";
               document.getElementById("edit_vacancy_id").submit();

           }
       }

    </script>
    </body>
</html>
