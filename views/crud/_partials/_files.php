<?php if (\Request::active()->action == 'finish'): ?>
<h3>Files</h3>
<?php foreach($stencil['data']['files'] as $key => $file): ?>
	<?php $data['file_header'] = Crude\Stencil::file_header($file['output_path'], $TBL_NAME, $STENCIL_NAME); ?>

	<?php if (Crude\Stencil::get(Crude\Table::get('crud.STENCIL_NAME'),'enable_download')): ?>
		<h4>
			<span class="show_hide" onclick="ShowHide('<?php echo $key; ?>', this, '+', '-');">+</span>
			<span class="black_text"><?php echo $file['output_path']; ?></span>
			<div id="<?php echo $key; ?>" class="code_block">
				<!--span class="select_all" onclick="SelectText('<?php echo $key; ?>_code');">select all</span-->
				<div id="<?php echo $key; ?>_code" class="code">
				<?php echo highlight_string(\View::factory($file['stencil_path'], $data, true), true); ?>
				</div>
			</div>
		</h4>
	<?php else: ?>
		<code><?php echo \View::factory($file['stencil_path'], $data, true); ?></code>
	<?php endif; ?>

<?php endforeach; ?>
<?php endif; ?>