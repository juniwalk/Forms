<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Form
 * @link      https://github.com/juniwalk/form
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Form\Tests\Files;

use Nette\Application\UI\Form as NetteForm;
use Nette\Utils\ArrayHash;

final class Form extends \JuniWalk\Form\AbstractForm
{
	/**
	 * @param  string  $name
	 * @return static
	 */
	public function setDefaults($name)
	{
		$this->getForm()->setDefaults([
			'name' => $name,
		]);

		return $this;
	}


	public function fireEvents()
	{
		$form = $this->getForm();
		$form->setSubmittedBy($form['submit']);
		$form->fireEvents();
	}


	public function disableProtection()
	{
		$form = $this->getForm();
		unset($form[$form::PROTECTOR_ID]);
	}


	/**
	 * @param  string  $name
	 * @return NetteForm
	 */
	protected function createComponentForm(string $name) : NetteForm
	{
		$form = parent::createComponentForm($name);
		$form->addText('name', 'test.form.name');

		$form->addSubmit('submit', 'test.form.submit');

		return $form;
	}
}
