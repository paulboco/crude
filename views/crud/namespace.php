<h1>Define a namespace</h1>

<p>Doing so will namespace all class files.</p>

<?php echo Form::open(); ?>
<label>Namespace:</label>
<?php echo Form::input('NAMESPACE', $NAMESPACE, array('size' => 15, 'autofocus' => 'autofocus')); ?> (optional)

<p class="buttons">
	<?php echo Form::submit('default', 'Next', array('style' => 'position: absolute; left: -200px; top: -200px;')); ?>
	<?php echo Form::submit('submit', 'Restart'); ?>&nbsp;
	<?php echo Form::submit('submit', 'Next'); ?>&nbsp;
</p>

<?php echo Form::close(); ?>
