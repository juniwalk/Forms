<?php

/**
 * TEST: Basic functionality of FormControl.
 * @testCase
 *
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Form
 * @link      https://github.com/juniwalk/form
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Form\Tests\Cases;

use JuniWalk\Form\Tests\Files;
use Tester\Assert;

require __DIR__.'/../bootstrap.php';

final class FormControlTest extends \Tester\TestCase
{
	public function testIntegrity()
	{
		$form = $this->createForm()->getForm();
		Assert::type('Nette\Localization\ITranslator', $form->getTranslator());
		Assert::type('Nette\Forms\IFormRenderer', $form->getRenderer());
	}


	public function testEventHandler()
	{
		$form = $this->createForm()->setDefaults('Martin');
		$form->onSuccess[] = function ($form, $data) {
			Assert::same('Martin', $data->name);
			$form->addError('test.form.csrf');
		};

		$form->onError[] = function ($form) {
			Assert::false(empty($form->getErrors()));
		};

		$form->fireEvents();
	}


	/**
	 * @return Form
	 */
	private function createForm()
	{
		$form = new Files\Form;
		$form->setTranslator(new Files\Translator);
		$form->setRenderer(new Files\Renderer);
		$form->disableProtection();

		return $form;
	}
}

(new FormControlTest)->run();
