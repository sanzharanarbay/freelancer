<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  		<div class="alert alert-warning" role="alert">
           <?php echo $error ?>
          </div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>