<?php
namespace Gt\Input\InputData;

use Gt\Input\InputData\Datum\InputDatum;

trait KeyValueArrayAccess {
	public function offsetExists($offset):bool {
		return isset($this->parameters[$offset]);
	}

	public function offsetGet($offset):?InputDatum {
		return $this->getDatum($offset);
	}

	public function offsetSet($offset, $value):void {
		if($this->parameters instanceof InputData) {
			if(is_string($value)) {
				$this->parameters->addKeyValue($offset, $value);

			}
			else {
				$this->parameters->add($offset, $value);
			}
		}
		else {
			if(is_string($value)) {
				$value = new InputDatum($value);
			}

			$this->parameters[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		if($this->parameters instanceof InputData) {
			$this->parameters->remove($offset);
		}
		else {
			unset($this->parameters[$offset]);
		}
	}
}