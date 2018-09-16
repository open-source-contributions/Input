<?php
namespace Gt\Input\Test\Helper;

class HTMLHelper {
	const HTML_FORM_NO_SECURE = <<<HTML
<!doctype html>
<h1>Example form without secure field</h1>

<form method="post">
	<label>
		<span>Your name</span>
		<input name="name" required />
	</label>
	
	<label>
		<span>Your age</span>
		<input name="age" required />
	</label>
	
	<button>Submit</button>
</form>
HTML;

	const HTML_FORM_SECURE = <<<HTML
<!doctype html>
<h1>Example form with secure field</h1>

<form method="post">
	<label>
		<span>Your name</span>
		<input name="name" required />
	</label>
	
	<label>
		<span>Your credit card number</span>
		<input name="credit-card" required data-secure />
	</label>
	
	<button>Submit</button>
</form>
HTML;

}