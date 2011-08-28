<?php if (\Request::active()->action == 'tables'): ?>
<h5 class="help">Tables</h5>
<p class="help">
	Table names highlighted in <span style="color:crimson;">red</span>
	contain underscores but no table prefix is configured for the database.
	The code generated will not work as is and must be modified to account for these underscores.
</p>

<p class="help">
	Table names are disabled when a table prefix is configured but not found in a table's name.
</p>

<h5 class="help">Links</h5>
<p class="help">
	Links are disabled when a table prefix is configured but not found in a table's name, or they have been omitted in the stencil configuration file.
</p>

<h5 class="help">Tips</h5>
<p class="help">
	The default stencil can be defined in CRUDEPATH/config/crude.php.
</p>
<?php endif; ?>

<?php if (\Request::active()->action == 'namespace'): ?>
<h5 class="help">Namespace</h5>
<p class="help">
	This comes in handy for modules.
</p>
<?php endif; ?>

<?php if (\Request::active()->action == 'validation'): ?>
<h5 class="help">Enum Types</h5>
<p class="help">
	Columns of type 'enum' are omitted as I see no need for their validation.
</p>
<?php endif; ?>

