<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class FormComponentsProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register current provider components only for admin requests
		if (!request()->is('admin*')) {
			return;
		}
		// Register Bootstrap form components
		Form::component('bsMultitext',     'admin.components.multitext',
			['name', 'label', 'value', 'attributes' => [] , 'key']);

		Form::component('bsText',     'admin.components.text',
			['name', 'label', 'value', 'attributes' => [] , 'showError' => true]);

		Form::component('bsLink', 'admin.components.pages',
			['name', 'linkId', 'value', 'attributes' => [], 'dotSeparated' => false]);

		Form::component('bsMultiemail',     'admin.components.multiemail',
			['name', 'label', 'value', 'attributes' => [] , 'key']);

		Form::component('bsTextarea', 'admin.components.textarea',
			['name', 'label','value', 'attributes' => [] , 'showError' => true]);

		Form::component('bsDatepicker', 'admin.components.datepicker',
			['name', 'label','value', 'attributes' => [], 'defaults' => []]);

		Form::component('bsMultiDatepicker', 'admin.components.multidatepicker',
			['name', 'label','value', 'attributes' => [], 'defaults' => [], 'key']);

		Form::component('bsSelect',   'admin.components.select',
			['name', 'label', 'options', 'value' => null, 'attributes' => [], 'showError' => true]);

		Form::component('bsSubmit',   'admin.components.submit',
			['text', 'attributes' => []]);

		Form::component('bsPassword', 'admin.components.password',
			['name', 'title' => NULL, 'attributes' => []]);

		Form::component('bsRadio', 'admin.components.radio',
			['name','options','label','checked'=>null,'attributes'=>[], 'showError' => true]);

		Form::component('bsCheckbox', 'admin.components.checkbox',
			['name','label','checked' => null,'disabled' => false, 'class' => null, 'showError' => true]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}