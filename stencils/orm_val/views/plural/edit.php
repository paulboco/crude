<h2>Edit <?php echo $TBL_UCSINGULAR; ?></h2>

<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/index', 'Listing'); <?php echo '?>'.PHP_EOL; ?>
 |
<?php echo '<?php'; ?> echo Html::anchor('<?php echo $TBL_PLURAL; ?>/view/'.$<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?>, 'View'); <?php echo '?>'.PHP_EOL; ?>

<?php echo '<?php'; ?> echo render('<?php echo $TBL_PLURAL; ?>/_form'); <?php echo '?>'.PHP_EOL; ?>
