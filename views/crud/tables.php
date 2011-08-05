<!-- select stencil -->
<h1>Select a Stencil and click a Table</h1>

<div class="float_left">
	<?php echo Form::open(array('name' => 'form1'), array('STENCIL_NAME' => $STENCIL_NAME, 'change_stencil' => '1')); ?>
	<label>Stencil</label>
	<?php echo Form::select('STENCIL_NAME', $STENCIL_NAME, $STENCIL_OPTIONS, array('onchange' => 'this.form.submit()')); ?>
	<?php echo Form::close(); ?>
</div>

<div id="stencil_desc" class="float_left">
	<i></i><?php echo $stencil['data']['desc']; ?></i>
</div>

<div class="block_clear"><br></div>

<p>
	<strong>Tables</strong> in the currently configured database (shown to the right) are listed below.
</p>

<p>
	Click 'Wizard' to configure each step of the process, or click 'Express' to get this CRUD over with.<br>
</p>

<?php if (empty($tables)): ?>
	<p>No Tables Found</p>
<?php else: ?>
	<table class="crud">
		<?php foreach ($tables as $table_name => $table_class): ?>
		<tr>
			<th class="<?php echo $table_class; ?>"><?php echo $table_name; ?></th>
<?php $omissions = Crude\Stencil::get(Crude\Table::get('crud.STENCIL_NAME'),'table_link_omissions'); ?>
<?php if ( ! in_array('Wizard', $omissions) and substr($table_name, 0, strlen($TBL_PREFIX)) == $TBL_PREFIX): ?>
			<td class="center"><?php echo Html::anchor(Uri::create('crude/crud/namespace/'.$table_name.'/load'), 'Wizard'); ?></td>
<?php else: ?>
			<td class="center" style="color:silver;">Wizard</td>
<?php endif; ?>
<?php if ( ! in_array('Express', $omissions) and substr($table_name, 0, strlen($TBL_PREFIX)) == $TBL_PREFIX): ?>
			<td class="center"><?php echo Html::anchor(Uri::create('crude/crud/finish/'.$table_name.'/load'), 'Express'); ?></td>
<?php else: ?>
			<td class="center" style="color:silver;">Express</td>
<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="block_clear"></div>
