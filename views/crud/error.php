<h1>CRUD Error</h1>

<p>Please correct the following errors and
<?php echo Html::anchor(Uri::create('crude/crud/tables'), 'try again'); ?>
</p>

<br>

<?php if (empty($errors)): ?>
<p>No errors detected. Click <?php echo Html::anchor(Uri::create('crude/crud/tables'), 'try again'); ?>.</p>
<?php else: ?>
<?php echo $text = ''; ?>
<?php foreach($errors as $error): ?>
	<div style="border:solid 0px;width:500px;">
	<p><b><?php echo $error['level']; ?>:</b><br><?php echo $error['text']; ?></p>
	</div>
	<br>
<?php endforeach; ?>
<?php endif; ?>