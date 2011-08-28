<?php foreach ($COLUMNS as $column): ?>
<p>
	<strong><?php echo $column['HUMANIZE']; ?>:</strong>
	<?php echo '<?php'; ?> echo $<?php echo $TBL_SINGULAR.'->'.$column['NAME']; ?>; <?php echo '?>'; ?>

</p>

<?php endforeach; ?>

<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/edit/'.$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>, 'Edit'); <?php echo '?>'; ?> |
<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>', 'Listing'); <?php echo '?>'; ?>
