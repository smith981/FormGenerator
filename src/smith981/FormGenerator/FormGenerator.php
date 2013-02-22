<?php

namespace smith981\FormGenerator;

/**
* Form generator class
*/

/**
 * @todo add methods for retrieveById, update, delete
 */

class FormGenerator
{
	/**
	 * Generate a form object from an annotated Doctrine model class file reflection
	 *
	 * @todo We create the form in line 31. But how do we set the element type for each field?
	 * 
	 * @param  \Zend\Code\Reflection\FileReflection $reflection the reflection of the model class file
	 * @return \Zend\Form                                           
	 */
	public static function generateCreateFormFromFileReflection(\Zend\Code\Reflection\FileReflection $reflection) {
		$form = new \Zend\Form\Form();
		$classes = $reflection->getClasses();

		/**
		 * If the code is structured correctly, there should only be one $class in $classes
		 */
		$builder = new \Zend\Form\Annotation\AnnotationBuilder();
		$form    = $builder->createForm($classes[0]->getName());

		$csrf = new \Zend\Form\Element\Csrf('security');

		$submit = new \Zend\Form\Element('send');
		$submit->setValue('Submit');
		$submit->setAttributes(array(
    		'type'  => 'submit'
		));

		$form->add($csrf);
		$form->add($submit);

		$form->setLabel('Create New "' . $classes[0]->getName() . '"');

		return $form;
	}
	
}