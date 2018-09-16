<?php
namespace Gt\Input\Security;

use Gt\Dom\Element;

class FormFieldDetector {
	public static function hasSecureFields(Element $form):bool {
		$secureField = $form->querySelector("[data-secure]");

		if(is_null($secureField)) {
			return false;
		}
		else {
			return true;
		}
	}
}