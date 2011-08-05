<h1>Finish</h1>
<p>Preview the code and download the files.</p>
<br>

<p class="buttons">
	<?php echo Form::open(array('name' => 'form2'), array('STENCIL_NAME' => $STENCIL_NAME, 'change_stencil' => '1')); ?>
	<?php echo Form::submit('submit', 'Back'); ?>&nbsp;
	<?php if (Crude\Stencil::get(Crude\Table::get('crud.STENCIL_NAME'),'enable_download')): ?>
		<?php echo Form::submit('submit', 'Download Zip', array('autofocus' => 'autofocus')); ?>
	<?php endif; ?>
	<?php echo Form::close(); ?>
</p>