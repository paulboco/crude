<?php echo Form::open(); ?>

<h1>Validation</h1>
<p>Check the input fields that are required.</p>

<table class="crud">
	<tr>
		<th></th>
		<th>Required</th>
	</tr>
	<?php foreach ($COLUMNS as $key => $column): ?>
		<?php if ( ! $column['OMISSIONS']['MODEL'] and ! $column['OMISSIONS']['FORM'] and $column['TYPE'] != 'enum'): ?>
		<?php $checked = ($column['VALIDATION']['REQUIRED']) ? array('checked') : array(); ?>
		<tr>
			<th class="bold"><?php echo $key; ?></th>
			<td>
				<?php echo Form::hidden('COLUMNS['.$key.'][VALIDATION][REQUIRED]', '0'); ?>
				<?php echo Form::checkbox('COLUMNS['.$key.'][VALIDATION][REQUIRED]', '1', $checked); ?>
			</td>
		</tr>
		<?php endif; ?>
	<?php endforeach; ?>
</table>

<p class="buttons">
	<?php echo Form::submit('submit', 'Back'); ?>&nbsp;
	<?php echo Form::submit('submit', 'Next', array('autofocus' => 'autofocus')); ?>
</p>

<?php echo Form::close(); ?>
