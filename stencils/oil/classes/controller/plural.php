<?php echo '<?php'.PHP_EOL; ?>

<?php echo $file_header ?>

<?php if ($NAMESPACE) echo 'namespace '.$NAMESPACE.';'.PHP_EOL.PHP_EOL; ?>
class Controller_<?php echo $TBL_UCPLURAL; ?> extends Controller_Template {

	/**
	 * Index
	 */
	public function action_index()
	{
		$data['<?php echo $TBL_PLURAL; ?>'] = Model_<?php echo $TBL_UCSINGULAR; ?>::find('all');
		$this->template->title = "<?php echo $TBL_UCPLURAL; ?>";
		$this->template->content = View::factory('<?php echo $TBL_PLURAL; ?>/index', $data);
	}

	/**
	 * View
	 */
	public function action_view($<?php echo $TBL_PK; ?> = null)
	{
		$data['<?php echo $TBL_SINGULAR; ?>'] = Model_<?php echo $TBL_UCSINGULAR; ?>::find($<?php echo $TBL_PK; ?>);

		$this->template->title = "<?php echo $TBL_UCPLURAL; ?>";
		$this->template->content = View::factory('<?php echo $TBL_PLURAL; ?>/view', $data);
	}

	/**
	 * Create
	 */
	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$<?php echo $TBL_SINGULAR; ?> = Model_<?php echo $TBL_UCSINGULAR; ?>::factory(array(
<?php foreach ($COLUMNS as $key => $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and $column['NAME'] != $TBL_PK): ?>
				'<?php echo $column['NAME']; ?>'<?php echo $column['PAD']; ?>=> Input::post('<?php echo $column['NAME']; ?>'),
<?php endif; ?>
<?php endforeach; ?>
			));

			if ($<?php echo $TBL_SINGULAR; ?> and $<?php echo $TBL_SINGULAR; ?>->save())
			{
				Session::set_flash('notice', 'Added <?php echo $TBL_SINGULAR; ?> #' . $<?php echo $TBL_SINGULAR; ?>-><?php echo $TBL_PK; ?> . '.');
				Response::redirect('<?php echo $TBL_PLURAL; ?>');
			}
			else
			{
				Session::set_flash('notice', 'Could not save <?php echo $TBL_SINGULAR; ?>.');
			}
		}

		$this->template->title = "<?php echo $TBL_UCPLURAL; ?>";
		$this->template->content = View::factory('<?php echo $TBL_PLURAL; ?>/create');
	}

	/**
	 * Edit
	 */
	public function action_edit($<?php echo $TBL_PK; ?> = null)
	{
		$<?php echo $TBL_SINGULAR; ?> = Model_<?php echo $TBL_UCSINGULAR; ?>::find($<?php echo $TBL_PK; ?>);

		if (Input::method() == 'POST')
		{
<?php foreach ($COLUMNS as $key => $column): ?>
<?php if ( ! $column['OMISSIONS']['MODEL'] and $column['NAME'] != $TBL_PK): ?>
				$<?php echo $TBL_SINGULAR; ?>-><?php echo $column['NAME']; ?><?php echo $column['PAD']; ?>= Input::post('<?php echo $column['NAME']; ?>');
<?php endif; ?>
<?php endforeach; ?>

			if ($<?php echo $TBL_SINGULAR; ?>->save())
			{
				Session::set_flash('notice', 'Updated <?php echo $TBL_SINGULAR; ?> #' . $<?php echo $TBL_PK; ?>);
				Response::redirect('<?php echo $TBL_PLURAL; ?>');
			}
			else
			{
				Session::set_flash('notice', 'Could not update <?php echo $TBL_SINGULAR; ?> #' . $<?php echo $TBL_PK; ?>);
			}
		}
		else
		{
			$this->template->set_global('<?php echo $TBL_SINGULAR; ?>', $<?php echo $TBL_SINGULAR; ?>);
		}

<?php foreach ($COLUMNS as $key => $column): ?>
<?php if (isset($column['OPTIONS']) and $column['TYPE'] == 'enum' and $column['INPUT']['SELECTED'] == 'select'): ?>
		$this->template->set_global('<?php echo $column['NAME']; ?>_options', Model_<?php echo $TBL_UCSINGULAR; ?>::get_<?php echo $column['NAME']; ?>_options());
<?php endif; ?>
<?php endforeach; ?>
		$this->template->title = "<?php echo $TBL_UCPLURAL; ?>";
		$this->template->content = View::factory('<?php echo $TBL_PLURAL; ?>/edit');
	}

	/**
	 * Delete
	 */
	public function action_delete($<?php echo $TBL_PK; ?> = null)
	{
		if ($<?php echo $TBL_SINGULAR; ?> = Model_<?php echo $TBL_UCSINGULAR; ?>::find($<?php echo $TBL_PK; ?>))
		{
			$<?php echo $TBL_SINGULAR; ?>->delete();

			Session::set_flash('notice', 'Deleted <?php echo $TBL_SINGULAR; ?> #' . $<?php echo $TBL_PK; ?>);
		}
		else
		{
			Session::set_flash('notice', 'Could not delete <?php echo $TBL_SINGULAR; ?> #' . $<?php echo $TBL_PK; ?>);
		}

		Response::redirect('<?php echo $TBL_PLURAL; ?>');
	}

}