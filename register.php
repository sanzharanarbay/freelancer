<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Регистрация</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <!-- Custom styles for this template -->
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="assets/css/register.css"> 
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
</head>
<body class="text-center">

	
<div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Заказчик</a></li>
        <li class="tab"><a href="#login">Фрилансер</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Зарегистрируйтесь Бесплатно!</h1>
          
          <form  method="post" action="register.php">
          <?php include('errors.php'); ?>
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Фамилия<span class="req">*</span>
              </label>
              <input type="text" name="lastname" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Имя<span class="req">*</span>
              </label>
              <input type="text" name="firstname" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              E-mail адрес<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
             Логин<span class="req">*</span>
            </label>
            <input type="text" name="username" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
            Мобильный Телефон<span class="req">*</span>
            </label>
            <input type="tel" name="phonenumber" maxlength="12" required autocomplete="off"/>
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
    
    <select class="custom-select my-select" name="state" id="state" required autocomplete="off">
        <option value="">Выберите страну</option>
    </select>
	<br><br>
    
    <select class="custom-select my-select" name="city" id="city" required autocomplete="off">
        <option value="">Выберите регион</option>
    </select>
    </div>
          
          <div class="field-wrap">
            <label>
              Придумайте пароль<span class="req">*</span>
            </label>
            <input type="password" name="password_1" minlength="8" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Потвердите пароль<span class="req">*</span>
            </label>
            <input type="password" name="password_2" minlength="8" required autocomplete="off"/>
          </div>
          <input type="hidden" name="roleid" value="3">
          <button type="submit" name="reg_cus" class="button button-block"/>Зарегистрироваться</button><br>
				<span class="home"><a  href="login.php">Уже имеете аккаунт? Вход</a></span>
				<span class="back"><a  href="index.php">Главная</a></span>
          </form>

        </div>
        
        <div id="login">   
        <h1>Зарегистрируйтесь Бесплатно!</h1>
        <?php include('errors.php'); ?>
        <form action="register.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Фамилия<span class="req">*</span>
              </label>
              <input type="text" name="flastname" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Имя<span class="req">*</span>
              </label>
              <input type="text" name="ffirstname" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              E-mail адрес<span class="req">*</span>
            </label>
            <input type="email" name="femail" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
             Логин<span class="req">*</span>
            </label>
            <input type="text" name="fusername" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
            Мобильный Телефон<span class="req">*</span>
            </label>
            <input type="tel" name="fphonenumber" maxlength="12" required autocomplete="off"/>
          </div>
          
          <?php
    //Include database configuration file
    include('config.php');
    
    //Get all country data
    $querys = "SELECT * FROM countries  ORDER BY country_name ASC";
    $run_querys = mysqli_query($con, $querys);
    //Count total number of rows
	$counts = mysqli_num_rows($run_querys);
    
    ?>

                <div class="form-group">
                <select  class="custom-select my-select"  name="fcountry" id="fcountry" required autocomplete="off" >
              <option value="">Выберите страну</option>
              <?php
              if($counts > 0){
                  while($rows = mysqli_fetch_array($run_querys)){
              $country_ids=$rows['country_id'];
              $country_names=$rows['country_name'];
                      echo "<option value='$country_ids'>$country_names</option>";
                  }
              }else{
                  echo '<option value="">Страна не доступна</option>';
              }
              ?>
          </select><br><br>
          
          <select class="custom-select my-select" name="fstate" id="fstate" required autocomplete="off">
              <option value="">Выберите страну</option>
          </select>
        <br><br>
          
          <select class="custom-select my-select" name="fcity" id="fcity" required autocomplete="off">
              <option value="">Выберите регион</option>
          </select>
          </div>

          <div class="field-wrap">
            <label>
              Придумайте пароль<span class="req">*</span>
            </label>
            <input type="password" name="fpassword_1" minlength="8" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Потвердите пароль<span class="req">*</span>
            </label>
            <input type="password" name="fpassword_2" minlength="8" required autocomplete="off"/>
          </div>
          
          <input type="hidden" name="froleid" value="4">
          <button type="submit" name="reg_free" class="button button-block"/>Зарегистрироваться</button><br>
				<span class="home"><a  href="login.php">Уже имеете аккаунт? Вход</a></span>
				<span class="back"><a  href="index.php">Главная</a></span>
          </form>


        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<script type="text/javascript">
$(document).ready(function(){
    $('#fcountry').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#fstate').html(html);
                    $('#fcity').html('<option value="">Выберите регион</option>'); 
                }
            }); 
        }else{
            $('#fstate').html('<option value="">Выберите страну</option>');
            $('#fcity').html('<option value="">Выберите регион</option>'); 
        }
    });
    
    $('#fstate').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#fcity').html(html);
                }
            }); 
        }else{
            $('#fcity').html('<option value="">Выберите регион</option>'); 
        }
    });
});
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="assets/js/signin.js"></script>
</body>
</html>