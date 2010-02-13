<fieldset>
<legend>Models</legend>
<ul>
	<?php foreach($models as $model): ?>
	<li><?php echo html::anchor('scaffold/show/'.$model, $model) ?></li>
	<?php endforeach; ?>
</ul>
</fieldset>