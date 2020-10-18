<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <h5 align='center' style="background-color:Tomato; color:white"><?php echo $error ?></h5>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
<?php  if (count($usn_err) > 0) : ?>
  <div class="error">
  	<?php foreach ($usn_err as $err) : ?>
  	  <p color='red'><?php echo $err; ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
