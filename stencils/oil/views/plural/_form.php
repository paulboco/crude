<?php echo "<?php echo Form::open(array('id' => 'form1')); ?>".PHP_EOL; ?>

<?php foreach ($COLUMNS as $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and ! $column['OMISSIONS']['FORM'] and $column['NAME'] != $TBL_PK): ?>
	<p>
		<label for="form1_<?php echo $column['NAME']; ?>"><?php echo $column['HUMANIZE']; ?>:</label>
<?php
switch($column['TYPE'])
{
	case 'text':
		echo "\t\t<?php echo Form::textarea('{$column['NAME']}', Input::post('{$column['NAME']}', isset(\${$TBL_SINGULAR}) ? \${$TBL_SINGULAR}->{$column['NAME']} : ''), array('id' => 'form1_{$column['NAME']}')); ?>".PHP_EOL;
		break;

	case 'enum':
		if ($column['INPUT']['SELECTED'] == 'radio')
		{
			foreach ($column['OPTIONS'] as $value => $label)
			{
echo "\t\t<?php echo Form::radio('{$column['NAME']}', '{$value}', (isset(\${$TBL_SINGULAR}) and \${$TBL_SINGULAR}->{$column['NAME']} == '{$value}') ? array('checked', 'id' => 'form1_{$column['NAME']}_{$value}') : array('id' => 'form1_{$column['NAME']}_{$value}')); ?>".PHP_EOL;
echo "\t\t<label for=\"form1_{$column['NAME']}_{$value}\">{$label}</label>".PHP_EOL;
			}
		}

		if ($column['INPUT']['SELECTED'] == 'select')
		{
echo "\t\t<?php echo Form::select('{$column['NAME']}', Input::post('{$column['NAME']}', isset(\${$TBL_SINGULAR}) ? \${$TBL_SINGULAR}->{$column['NAME']} : ''), \${$column['NAME']}_options, array('id' => 'form1_{$column['NAME']}')); ?>".PHP_EOL;
		}

		break;

	default:
		echo "\t\t<?php echo Form::input('{$column['NAME']}', Input::post('{$column['NAME']}', isset(\${$TBL_SINGULAR}) ? \${$TBL_SINGULAR}->{$column['NAME']} : ''), array('id' => 'form1_{$column['NAME']}')); ?>";

}
?>
	</p>

<?php endif; ?>
<?php endforeach; ?>
	<div class="actions">
		<?php echo '<?php echo Form::submit(); ?>'.PHP_EOL; ?>
	</div>

<?php echo '<?php echo Form::close(); ?>'; ?>