<?php
	if(isset($msg) && !empty($msg))
	{
		echo "<div class=\"post\">";
		echo "<h3>".$msg."</h3>";
		echo "</div>";
	} 
?>

<?php 
  echo form_open('install/start');
?>

<?php 			
	if (!$database_connected)
	{
?>
<div class="post bump login"> 
	<div class="">
		<h2>Database Information</h2>
	</div>

	<div class="install_left">
    	<?=form_label('Host', 'host')?>		
    	<?=form_label('Database', 'database')?>
    	<?=form_label('User', 'user')?>	
    	<?=form_label('Password', 'password')?>	
	</div>
	
	<div class="install_right">
    	<?=form_input(array('class' => 'install_box', 'name' => 'host', 'id' => 'host','value' => set_value("host")))?>
		<?=form_input(array('class' => 'install_box', 'name' => 'database', 'id' => 'database','value' => set_value("database")))?>
		<?=form_input(array('class' => 'install_box', 'name' => 'user', 'id' => 'user','value' => set_value("user")))?>
		<?=form_input(array('class' => 'install_box', 'name' => 'password', 'id' => 'password','value' => set_value("password")))?>
		<input type="submit" name="submit" value="Install" class="submit" />
	</div>
	<div style="clear:both"></div>	
</div>			
	<?php } ?>