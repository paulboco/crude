<h2><?php echo $TBL_UCPLURAL; ?></h2>

<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/create', 'Add New <?php echo $TBL_UCSINGULAR; ?>'); ?>

<table class="listing">
	<thead>
		<tr>
<?php foreach ($COLUMNS as $key => $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and ! $column['OMISSIONS']['LISTING']): ?>
			<th><?php echo $column['HUMANIZE']; ?></th>
<?php endif; ?>
<?php endforeach; ?>
			<th colspan="3">&nbsp;</th>
		</tr>
	</thead>

	<tbody>
		<?php echo '<?php'; ?> foreach ($<?php echo $TBL_PLURAL; ?> as $<?php echo $TBL_SINGULAR; ?>): <?php echo '?>'.PHP_EOL; ?>
		<tr>
<?php foreach ($COLUMNS as $key => $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and ! $column['OMISSIONS']['LISTING']): ?>
			<td><?php echo '<?php'; ?> echo $<?php echo $TBL_SINGULAR; ?>-><?php echo $column['NAME']; ?>; <?php echo '?>'; ?></td>
<?php endif; ?>
<?php endforeach; ?>
			<td>
				<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/view/'.$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>, 'View'); ?> |
				<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/edit/'.$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>, 'Edit'); ?> |
				<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/delete/'.$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>, 'Delete', array('onclick' => "return confirm('Are you sure you want to delete <?php echo $TBL_SINGULAR; ?> #{$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>}?');")); <?php echo '?>'.PHP_EOL; ?>
			</td>
		</tr>
		<?php echo '<?php'; ?> endforeach; <?php echo '?>'.PHP_EOL; ?>
	</tbody>
</table>
