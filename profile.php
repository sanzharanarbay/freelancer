    <?php 
 include('to_edit_profile.php') ;
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>
<?php  if (isset($_SESSION['username'])  && (($_SESSION['role_id']== 4 || $_SESSION['role_id']== 3))) { ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Профиль</title>
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
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">


        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" type="text/css">

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.1.2/bootstrap-show-password.js"></script>

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
                                .search-icon {
                                    position: absolute;
                                    top: 3px;
                                    right: 60px;
                                    font-size: 18px;
                                }
                                
                                .showpass{
                                    position: absolute;
                                    top: 8px;
                                    right: 5%;
                                }
                                #methods {
                                    z-index: 10;
                                    opacity: 0;
                                    }
                                    #methods:hover {
                                    cursor: pointer;
                                    }
                                    #methods:checked ~ .fa-eye-slash {
                                    opacity: .5;
                                    }
                                    #methods:checked ~ .fa-eye {
                                    opacity: 0;
                                    }
                                #c-methods {
                                    z-index: 10;
                                    opacity: 0;
                                    }
                                    #c-methods:hover {
                                    cursor: pointer;
                                    }
                                    #c-methods:checked ~ .fa-eye-slash {
                                    opacity: .5;
                                    }
                                    #c-methods:checked ~ .fa-eye {
                                    opacity: 0;
                                    }

                                .showpass i {
                                    position: absolute;
                                    top: 5px;
                                    right: 5%;
                                    font-size: 1.5rem;
                                    color: #000 !important;
                                    opacity: .5;
                                }

                                #methods .fa-eye-slash {
                                    opacity: 0;
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
    <div class="col-md-3">
        <form class="form-inline">
        <input class="form-control searchbox" type="text" placeholder="Search" aria-label="Search">
        <span class="search-icon"><i class="fa fa-search"></i></span>
        </form>
    </div>
    
    <div class="content">
  	<!-- notification message -->
  	

    <!-- logged in user information -->
   
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

<div class="container">

    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Профиль</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Уведомления</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Настройки</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                <?php include('errors.php'); ?>
                    <h5 class="mb-3"><?php echo $user['u_firstname']." ". $user['u_lastname']; ?></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Контакты</h6>
                            <p style="color:blue;">
                               <?php echo $user['u_phonenumber']. " ".$user['email']; ?>
                            </p>
                            <h6>Hobbies</h6>
                            <p>
                                Indie music, skiing and hiking. I love the great outdoors.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6> Привелегия</h6>
                           
                            <span class="badge badge-primary"><i class="fa fa-user"></i>&nbsp;<?php echo  $user['r_name']; ?> </span>
                           
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                <?php
                if (isset($_SESSION['messages'])): ?>

                <div class="alert alert-<?=$_SESSION['msg_types']?>">
                    <?php
                    echo $_SESSION['messages'];
                    unset($_SESSION['messages']);
                    ?>

                </div>

                <?php endif ?>
                    <table class="table table-hover table-striped">
                        <tbody>                                    
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                </div>
                <div class="tab-pane" id="edit">
                    <form method="post" action="profile.php">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="ufirstname" value="<?php echo $user['u_firstname'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="ulastname" value="<?php echo $user['u_lastname'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="uemail" value="<?php echo $user['email'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Телефон</label>
                            <div class="col-lg-9">
                                <input id="phone" class="form-control" type="text" name="uphonenumber" value="<?php echo $user['u_phonenumber'];?>" maxlength="12">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Адрес</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="<?php echo $user['country_name'];?>" placeholder="Страна" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" value="<?php echo $user['city_name'];?>" placeholder="Город" disabled>
                            </div>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" value="<?php echo $user['state_name'];?>" placeholder="Регион" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя пользователя</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="<?php echo $user['username'];?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Пароль</label>
                            <div class="col-lg-9">
                                <input id="password" class="form-control" type="password"  name="upassword_1" value="<?php echo $pass;?>" minlength="8">
                                <label class="showpass">
                                    <input type="checkbox" id="methods" />
                                    <i class="far fa-eye"></i>
                                    <i class="far fa-eye-slash"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Повторите пароль</label>
                            <div class="col-lg-9">
                                <input class="form-control" id="c-password" type="password" name="upassword_2" value="<?php echo $pass;?>" minlength="8">
                                <label class="showpass">
                                    <input type="checkbox" id="c-methods" />
                                    <i class="far fa-eye"></i>
                                    <i class="far fa-eye-slash"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="reset" class="btn btn-secondary"> Отмена</button>
                                <button type="submit" class="btn btn-primary"  name="edit_profile"> Сохранить изменения</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <h6 class="mt-2">Upload a different photo</h6>
            <label class="custom-file">
                <input type="file" id="file" class="custom-file-input">
                <span class="btn btn-outline-primary">Choose file</span>
            </label>
        </div>
    </div>
</div>
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
>
        <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>
        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
           $(document).ready(function () {
                $('#methods').click(function () {
                    $('#password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                    $('.wrap').toggleClass('background');
                });
                $('#c-methods').click(function () {
                    $('#c-password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                    $('.wrap').toggleClass('background');
                });
            });
        </script>
    </body>
</html>
