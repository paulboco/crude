<?php echo Form::open(); ?>

<h1>Check the columns to <strong>OMIT</strong> from the listing</h1>
<p>Some columns just aren't required.</p>

<table class="crud">
	<tr>
		<th></th>
		<th>Omit</th>
	</tr>
	<?php foreach ($COLUMNS as $key => $column): ?>
		<?php if ( ! $column['OMISSIONS']['MODEL']): ?>
		<?php $checked = ($column['OMISSIONS']['LISTING']) ? array('checked') : array(); ?>
		<tr>
			<th class="bold"><?php echo $key; ?></th>
			<td>
				<?php echo Form::hidden('COLUMNS['.$key.'][OMISSIONS][LISTING]', '0'); ?>
				<?php echo Form::checkbox('COLUMNS['.$key.'][OMISSIONS][LISTING]', '1', $checked); ?>
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
