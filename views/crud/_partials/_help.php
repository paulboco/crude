<?php if (\Request::active()->action == 'tables'): ?>
<p style="font-size:small;margin:0 0 20px 75px;line-height:1.1em;">
	Table names highlighted in <span style="color:crimson;">red</span>
	contain underscores but no table prefix is configured for the database.
	The code generated will not work as is and must be modified to account for these underscores.
</p>

<p style="font-size:small;margin:0 0 20px 75px;line-height:1.1em;">
	Table names are disabled when a table prefix is configured but not found in a table's name.
</p>

<p style="font-size:small;margin:0 0 20px 75px;line-height:1.1em;">
	Links are disabled when a table name doesn't contain the configured table prefix ,or they have been omitted in the stencil configuration file.
</p>
<?php endif; ?>

<?php if (\Request::active()->action == 'namespace'): ?>
<p style="font-size:small;margin:0 0 20px 75px;line-height:1.1em;">
	This comes in handy for modules.
</p>
<?php endif; ?>

