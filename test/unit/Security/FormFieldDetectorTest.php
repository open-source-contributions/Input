<?php
namespace Gt\Input\Test\Security;

use Gt\Dom\HTMLDocument;
use Gt\Input\Security\FormFieldDetector;
use Gt\Input\Test\Helper\HTMLHelper;
use PHPUnit\Framework\TestCase;

class FormFieldDetectorTest extends TestCase {
	public function testHasSecureFields() {
		$document = new HTMLDocument(
			HTMLHelper::HTML_FORM_NO_SECURE
		);
		$form = $document->forms[0];

		self::assertFalse(
			FormFieldDetector::hasSecureFields(
				$form
			)
		);

		$document = new HTMLDocument(
			HTMLHelper::HTML_FORM_SECURE
		);
		$form = $document->forms[0];

		self::assertTrue(
			FormFieldDetector::hasSecureFields(
				$form
			)
		);
	}
}
