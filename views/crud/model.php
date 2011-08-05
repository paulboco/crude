<h1>Check the columns to <strong>OMIT</strong> from the model</h1>

<p>
	These columns will not be accessible to the model.
</p>

<?php echo Form::open(); ?>

<table class="crud">
	<tr>
		<th></th>
		<th>Omit</th>
	</tr>
	<?php foreach ($COLUMNS as $key => $column): ?>
		<?php $checked = ($column['OMISSIONS']['MODEL']) ? array('checked') : array(); ?>
		<tr>
			<th class="bold"><?php echo $key; ?></th>
			<td>
				<?php echo Form::hidden('COLUMNS['.$key.'][OMISSIONS][MODEL]', '0'); ?>
				<?php echo Form::checkbox('COLUMNS['.$key.'][OMISSIONS][MODEL]', '1', $checked); ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>

<p class="buttons">
	<?php echo Form::submit('submit', 'Back'); ?>&nbsp;
	<?php echo Form::submit('submit', 'Next', array('autofocus' => 'autofocus')); ?>
</p>

<?php echo Form::close(); ?>
