<fieldset>
<legend>Models</legend>
<?php foreach($model_names as $mn): ?>
<?php echo html::anchor('scaffold/show/'.$mn, $mn) ?>,
<?php endforeach; ?>
</fieldset>
<br />

<?php

// Select list of columns
$col_list = array();
foreach($cols as $name=>$info)
	$col_list[$name] = $name;

?>

<fieldset>
<legend>Search</legend>
<?php echo form::open(url::current(), array('method'=>'get')) ?>
<?php if(isset($_GET['column_name'])): ?>
<?php echo form::hidden('column_name', $_GET['column_name']) ?>
<?php endif; ?>
<?php echo form::input('search', $_GET['search']) ?> 
In: <?php echo form::dropdown('column', $col_list, $_GET['column']) ?> 
<?php echo form::submit('', 'ok') ?>
<?php echo form::close() ?>
</fieldset>
<br />

<form name="result_list">
<fieldset>
<legend><?php echo $model_name ?> | <?php echo html::anchor('scaffold/edit/'.$model_name.'?uri='.urlencode(url::current(true)), 'Create') ?></legend>
<table class="results">
<tr>
	<th><input type="checkbox" onclick="select_all(this)" name="" /></th>
	<?php $_GET['dir'] = ($_GET['dir'] == 'asc') ? 'desc' : 'asc' ?>		
	<?php foreach($cols as $name=>$info): ?>
	<?php $_GET['sort'] = $name; ?>
	<th><?php echo html::anchor(url::current().'?'.http_build_query($_GET), $info['column']['label']) ?></th>
	<?php endforeach ?>
</tr>
<?php foreach($results as $result): ?>
<tr onclick="choose(<?php echo $result->$pk ?>, '<?php echo addcslashes($result->$pv, "\n'") ?>')">
	<td onclick="stop_bubble(event)"><input type="checkbox" name="<?php echo $result->$pk ?>" /></td>
	<?php foreach($cols as $name=>$info): ?>
	<td>
		<?php		
		$output = $result->$name;
		$url = false;
		
		// Display format for this column
		foreach(split('\|', $info['column']['display']) as $format)
		{
			preg_match('/([^\[]*)(\[(.*)\])?/', $format, $match);
			switch($match[1])
			{
				case 'password':
					$output = preg_replace('/./', '*', $output);
					break;
				case 'date':
					if(isset($match[3]))
						$output = strftime($match[3], $output);
					else
						$output = strftime(Kohana::config('scaffold.date_format'), $output);
					break;
				case 'trim':
					if(isset($match[3]))
						$output = substr(trim($output), 0, $match[3]);
					else
						$output = trim($output);
					break;
				case 'url':
					$url = true;
					break;
			}			
		}			
				
		if(!empty($url))
			echo html::anchor($output, $output, array('target'=>'_new', 'onclick'=>'stop_bubble(event)'));	
		else
			echo html::specialchars($output);
			
		// Show any links if the primary_val of the linked table exists as a column
		if(isset($info['link']) && isset($result->$info['link']['alias']->$info['column']['primary_val']))
			echo ' ['.$result->$info['link']['alias']->$info['column']['primary_val'].']'
		?>			
	</td>
	<?php endforeach ?>
</tr>
<?php endforeach; ?>
</table>
</fieldset>
</form>

<div style="overflow: auto">
	<div style="float: left">
		<?php echo $pages->render('digg') ?>
	</div>
	<div style="float: right;">
		<p>
		With Selected:
		<select onchange="with_action(this.options[this.selectedIndex].value); this.selectedIndex = 0;">
			<option></option>	
			<option value="Edit">Edit</option>	
			<option value="Remove">Remove</option>
		</select>
		</p> 
	</div>
</div>

<script language="javascript">
	document.getElementById('search').focus();

	function select_all(master)
	{
		fields = document.result_list;
				
		for(i = 0; i < fields.length; i++)
		{			
			if(fields[i].type == 'checkbox')
				fields[i].checked = master.checked;					
		}
	}
	
	function with_action(action)
	{		
		fields = document.result_list;
		ids = '';
		
		count = 0;		
		for(i = 0; i < fields.length; i++)
		{
			if((fields[i].type == 'checkbox') && fields[i].checked && (fields[i].name != ''))
			{
				ids += '&ids[]='+fields[i].name;
				count++;
			}					
		}		
		
		if(count == 0)
			return;
		
		if(action == 'Remove')
		{
			url = '<?php echo url::site('scaffold/remove/'.$model_name) ?>?ids='+ids+'&uri=<?php echo urlencode(url::current(true)) ?>';
			location.href = url;
		}
		else if(action == 'Edit')
		{
			url = '<?php echo url::site('scaffold/edit/'.$model_name) ?>?ids='+ids+'&uri=<?php echo urlencode(url::current(true)) ?>';
			location.href = url;
		}
	}
	
	function choose(id, val) 
	{
		<?php if(isset($_GET['column_name'])): ?>
		opener.select('<?php echo $_GET['column_name'] ?>', id, val);
		window.close();
		<?php else: ?>
		window.location.href = '<?php echo url::site('scaffold/edit/'.$model_name) ?>/'+id+'?uri=<?php echo urlencode(url::current(true)) ?>';
		<?php endif; ?>
	}
	
	function stop_bubble(e)
	{
		if(!e)
			e = window.event;
			
		e.cancelBubble = true;
		
		if(e.stopPropagation)
			e.stopPropagation();
	}	
</script>