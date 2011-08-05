<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title><?php echo $site_name; ?> | <?php echo $title; ?></title>

	<!-- css -->
	<style>
	<?php
	echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/global.css', true));
	echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/heading.css', true));
	echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/table.css', true));
	echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/header.css', true));
	echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/nav.css', true));
	//echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/debug.css', true));
	?>

	<?php if (isset($phpinfo)):
		echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/php.css', true));
	endif; ?>
	<?php if (isset($modal_msg)):
		echo Crude\Widget_Minify::render(File::read(CRUDEPATH.'assets/css/modal.css', true));
	endif; ?>
	</style>

	<!-- modal dialog -->
	<?php if (isset($modal_msg)): ?>
	<script type="text/javascript"><?php File::read(CRUDEPATH.'assets/js/packed.js', false); ?></script>
	<?php endif; ?>

</head>

<body>
<a name="top"></a>

	<div id="wrapper">

		<div id="header">
			<div id="logo">
				<?php echo Html::anchor('crude', $site_name.' '.$title); ?>
			</div>
			<div id="main_nav" class="nav">
				<?php echo Crude\Widget_Nav::render('public', '<span> | </span>'); ?>
			</div>
			<div class="section_seperator"></div>
		</div>

		<div id="content">
			<?php if (isset($breadcrumbs)): ?>
				<div class="nav">
					<?php echo Crude\Widget_Breadcrumbs::render($breadcrumbs, '<span> &gt; </span>'); ?>
				</div>
			<?php endif; ?>
			<?php echo $content; ?>
		</div>

		<div id="rightcolumn">
			<?php echo render('crud/_partials/_status'); ?>
			<div class="section_seperator"></div>
			<br><br><br><br>
			<?php echo render('crud/_partials/_help'); ?>
		</div>

		<div class="block_clear"></div>

		<div>
			<?php echo render('crud/_partials/_files'); ?>
		</div>

		<div id="footer">
			Fuel v<?php echo e(Fuel::VERSION); ?>
			<br />
			{exec_time}s {mem_usage}mb
		</div>

		<br>

		<div class="center"><span class="show_hide" onclick="ShowHide('temp', this, '+', '-');">+</span></div>
		<div id="temp">
			<a name="data"><?php Crude\Debug::vars(\Session::get(null), 9); ?></a>
			<br>
			<div class="center"><a href="#top">Top</a></div>
		</div>

	</div>


<script type="text/javascript">
<!--
function ShowHide(objId, e2, showtext, hidetext) {
	var e = document.getElementById(objId);
	if(e.style.display == 'block')
	{
		e.style.display = 'none';
		e2.innerHTML = showtext
	}
	else
	{
		e.style.display = 'block';
		e2.innerHTML = hidetext
	}
}

function SelectText(objId) {
	DeselectText();
	if (document.selection) {
		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(objId));
		range.select();
	}
	else if (window.getSelection) {
		var range = document.createRange();
		range.selectNodeContents(document.getElementById(objId));
		window.getSelection().addRange(range);
	}
}

function DeselectText() {
	if (document.selection)
		document.selection.empty();
	else if (window.getSelection)
		window.getSelection().removeAllRanges();
}

//-->
</script>



<!-- modal alert -->
<?php
if (isset($modal_msg)):
?>

<script type="text/javascript">
<!--

<?php if (is_array($modal_msg['text'])): ?>
var modal_id = '<?php echo $modal_msg['modal_id']; ?>';
<?php
	$text = '';
	foreach($modal_msg['text'] as $msg):
		$text .= '<p><b>'.$msg['level'].':</b><br>'.$msg['text'].'.</p>';
	endforeach;
	$modal_msg['text'] = $text;
endif;
?>

var text = '<?php echo $modal_msg['text']; ?>';
modal_show(text, modal_id);
function modal_show(text, modal_id)
{
	TINY.box.show({html:text,animate:true,close:true,maskid:'mask',opacity:40,boxid:modal_id});
}
//-->
</script>
<?php endif; ?>


</body>

</html>