<div class="post bump"> 	
	<h2>Installed!</h2>
	<p>That was all</p>
	<ul>
		<?php foreach($messages as $message): ?>
			<li><?=$message?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
header('refresh: 2; url='.base_url());
?>