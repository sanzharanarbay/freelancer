<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Вход</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="assets/css/login.css"> 
</head>

<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Вход</a></li>
      </ul>
      
      <div class="tab-content">
        
        
        <div id="login">   
          <h1>Пожалуйста авторизуйтесь!</h1>
          
          <form method="post" action="login.php">
          <?php include('errors.php'); ?>
           <div class="field-wrap">
            <label>
              Логин<span class="req">*</span>
            </label>
            <input type="text" name="username" required autocomplete="off"/>
           </div>
          
          <div class="field-wrap">
            <label>
              Пароль<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Забыли пароль?</a></p>
          
          <button type="submit" name="login_user" class="button button-block"/>Вход</button><br>
          <span class="home"><a  href="register.php">Нет аккаунта? Зарегестрируйтесь</a></span>
				  <span class="back"><a  href="index.php">Главная</a></span>
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="assets/js/register.js"></script>

</body>
</html>
