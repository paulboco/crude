<?php echo Form::open(); ?>

<h1>Design input form</h1>
<p>Change the label text if necessary and choose which input type to use for each column.</p>

<table class="crud">
	<tr>
		<th></th>
		<th>Label</th>
		<th>Type</th>
	</tr>
	<?php foreach ($COLUMNS as $key => $column): ?>
		<?php if ( ! $column['OMISSIONS']['MODEL'] and ! $column['OMISSIONS']['FORM']): ?>
		<tr>
			<th class="bold"><?php echo $key; ?></th>
			<td><?php echo Form::input('COLUMNS['.$key.'][HUMANIZE]', $column['HUMANIZE'], array('size'=>15)); ?>
			<td>
				<?php if ($column['INPUT']['OPTIONS']): ?>
				<?php echo Form::select('COLUMNS['.$key.'][INPUT][SELECTED]', $column['INPUT']['SELECTED'], $column['INPUT']['OPTIONS']); ?>
				<?php else: ?>
				No input option configured in crude config for column type <?php echo $column['TYPE']; ?>!
				<?php endif; ?>
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
