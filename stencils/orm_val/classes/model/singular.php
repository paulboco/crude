<?php echo '<?php'.PHP_EOL; ?>

<?php echo $file_header ?>

<?php if ($NAMESPACE): ?>
	<?php echo 'namespace '.$NAMESPACE.';'.PHP_EOL.PHP_EOL; ?>
<?php endif; ?>

class Model_<?php echo $TBL_UCSINGULAR; ?> extends Orm\Model {

	// define table name
	protected static $_table_name = '<?php echo $TBL_PLURAL; ?>';

	// define primary key
    protected static $_primary_key = array('<?php echo $TBL_PK; ?>');

	// define table columns
	protected static $_properties = array(
		'<?php echo $TBL_PK; ?>',
<?php foreach ($COLUMNS as $key => $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and $key != $TBL_PK): ?>
		'<?php echo $column['NAME']; ?>',
<?php endif; ?>
<?php endforeach; ?>
	);

<?php foreach ($COLUMNS as $key => $column): ?>
<?php if (isset($column['OPTIONS']) and $column['TYPE'] == 'enum' and $column['INPUT']['SELECTED'] == 'select'): ?>
	// options for <?php echo $column['NAME'].PHP_EOL; ?>
	public static function get_<?php echo $column['NAME']; ?>_options()
	{
		return array(
<?php foreach ($column['OPTIONS'] as $key => $value): ?>
			'<?php echo $key; ?>' => '<?php echo $value; ?>',
<?php endforeach; ?>
		);
	}

<?php endif; ?>
<?php endforeach; ?>
}