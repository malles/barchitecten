<?php
/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// register ElementOption class
App::getInstance('zoo')->loader->register('ElementOption', 'elements:option/option.php');

/*
	Class: ElementSelect
		The select element class
*/
class ElementSelectwidget extends ElementOption {

	/*
	   Function: edit
	       Renders the edit form field.

	   Returns:
	       String - html
	*/
	public function edit(){

		// init vars
		$options_from_config = $this->config->get('option', array());
		$default			 = $this->config->get('default');
		$name   			 = $this->config->get('name');

		if (count($options_from_config)) {

			// set default, if item is new
			if ($default != '' && $this->_item != null && $this->_item->id == 0) {
				$this->set('option', $default);
			}

			$options = array();
			foreach ($options_from_config as $option) {
				$options[] = $this->app->html->_('select.option', $option['value'], $option['name']);
			}


			$html[] = $this->app->html->_('select.genericlist', $options, $this->getControlName('option', true), '', 'value', 'text', $this->get('option', array()));

			// workaround: if nothing is selected, the element is still being transfered
			$html[] = '<input type="hidden" name="'.$this->getControlName('selectwidget').'" value="1" />';

			return implode("\n", $html);
		}

		return JText::_("There are no options to choose from.");
	}

}