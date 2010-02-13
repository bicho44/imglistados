<script language="javascript">
	function setup_cal(id, format)
	{
		Calendar.setup({
			inputField: id,
			  ifFormat: '%s',
		      daFormat: format,
		   displayArea: id+'_val',
			 showsTime: true
		});
	}

	function choose(column_name, model)
	{
		win = window.open('<?php echo url::site('scaffold/show') ?>/'+model+'?column_name='+column_name, '_blank', 'location=no,menubar=no,toolbar=no,titlebar=no,statusbar=no,width=700,height=580,scrollbars=yes');
	}

	function relationship(model, id, this_model)
	{
		url = '<?php echo url::site('scaffold/show') ?>/'+model+'?search='+id+'&column='+this_model+'_id';
		window.open(url, '_blank', 'location=no,menubar=no,toolbar=no,titlebar=no,statusbar=no,width=700,height=580,scrollbars=yes');
	}

	function select(column_name, id, val)
	{
		document.getElementById(column_name).value = id;
		document.getElementById(column_name+'_val').value = val;
	}
</script>

<fieldset>
<legend>Models</legend>
<?php foreach($model_names as $list_model): ?>
<?php echo html::anchor('scaffold/show/'.$list_model, $list_model) ?>,
<?php endforeach; ?>
</fieldset>
<br />

<fieldset>
<legend><?php echo $model_name ?></legend>
<?php
echo form::open(url::current(true));

foreach($cols as $name=>$info)
{
	echo form::label($name, $info['column']['label']);

	if(is_null($id) && ($name == $model->primary_key))
		$val = ''; // Don't show the ID if we're creating or editing multiple items
	else
		$val = $model->$name;

	if(isset($_GET['ids']))
		echo form::checkbox($name.'_enable', true).' ';

	if(is_file(APPPATH.'scaffold/'.$model_name.'/'.$name.EXT))
		include APPPATH.'scaffold/'.$model_name.'/'.$name.EXT;
	else if(isset($info['link']))
	{
		// Primary_key of foreign table is hidden
		echo '<input'.html::attributes(array('type'=>'hidden', 'id'=>$name, 'name'=>$name, 'value'=>$val)).' />';

		// Show the primary_val in the text box if it exists as a column
		if(isset($model->$info['link']['alias']->$info['column']['primary_val']))
			$val = $model->$info['link']['alias']->$info['column']['primary_val'];

		echo form::input(array('id'=>$name.'_val'), $val, 'readonly onclick="choose(\''.$name.'\', \''.$info['link']['model'].'\')"');
	}
	else
	{
		$ar = array('name'=>$name, 'style'=>$info['column']['style']);

		switch($info['column']['type'])
		{
			case 'textarea':
				echo form::textarea($ar, $val);
				break;
			case 'textbox':
				echo form::input($ar, $val);
				break;
			case 'password':
				echo form::password($ar);
				break;
			case 'dropdown':
				echo form::dropdown($ar, $info['column']['data'], (string)$val).' ';
				break;
			case 'date':
				$date_format = Kohana::config('scaffold.date_format');
				echo '<input'.html::attributes(array('type'=>'hidden', 'id'=>$name, 'name'=>$name, 'value'=>$val)).' />';
				echo form::input(array('id'=>$name.'_val'), strftime($date_format, $val), 'readonly');
				echo '<script language="javascript">setup_cal("'.$name.'", "'.$date_format.'");</script>';
				break;
		}
	}

	echo '<br />';
}

if(is_file(APPPATH.'scaffold/'.$model_name.'/_edit'.EXT))
	include APPPATH.'scaffold/'.$model_name.'/_edit'.EXT;

echo form::submit('', 'ok');
echo form::close();
?>
</fieldset>

<br />
<fieldset>
<legend>Relationships</legend>
<?php foreach($model->has_many as $c): ?>
<a href="javascript:void(relationship('<?php echo inflector::singular($c) ?>', <?php echo $model->id ?>, '<?php echo $model->object_name ?>'))"><?php echo $c.' ('.count($model->$c).')' ?></a>
<?php endforeach; ?>
</fieldset>
<br />