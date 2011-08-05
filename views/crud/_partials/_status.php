<?php if (\Config::get('db.'.\Config::get('environment').'.connection.database')): ?>
<div class="status_table">
	<table>
		<tr>
			<td class="key">Database</td>
			<td class="value"><?php echo \Config::get('db.'.\Config::get('environment').'.connection.database'); ?></td>
		</tr>
		<?php if (isset($TBL_NAME)): ?>
		<tr>
			<td class="key">Table</td>
			<td class="value"><?php echo $TBL_NAME; ?></td>
		</tr>
		<?php endif; ?>
		<?php if (isset($TBL_PREFIX)): ?>
		<tr>
			<td class="key">Table Prefix</td>
			<td class="value"><?php echo $TBL_PREFIX ?: '--'; ?></td>
		</tr>
		<?php endif; ?>
		<?php if (isset($TBL_PK)): ?>
		<tr>
			<td class="key">Primary Key</td>
			<td class="value"><?php echo $TBL_PK; ?></td>
		</tr>
		<?php endif; ?>
		<?php if (isset($STENCIL_NAME)): ?>
		<tr>
			<td class="key">Stencil</td>
			<td class="value"><?php echo $STENCIL_NAME; ?></td>
		</tr>
		<?php endif; ?>
	</table>
</div>
<?php endif; ?>
