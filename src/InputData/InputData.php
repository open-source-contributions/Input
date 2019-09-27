<?php
namespace Gt\Input\InputData;

use Gt\Input\InputData\Datum\InputDatum;
use Gt\Input\InputData\Datum\MultipleInputDatum;
use Gt\Input\InputValueGetter;

class InputData extends AbstractInputData {
	use InputValueGetter;

	public function __construct(iterable...$sources) {
		$this->parameters = [];

		foreach($sources as $source) {
			foreach($source as $key => $value) {
				if(is_array($value)
				&& isset($value[0])) {
					$value = new MultipleInputDatum($value);
				}
				else if(!$value instanceof InputDatum) {
					$value = new InputDatum($value);
				}
				$this->add($key, $value);
			}
		}
	}

	public function add(string $key, InputDatum $datum):self {
		$this->parameters[$key] = $datum;
		return $this;
	}

	public function addKeyValue(string $key, string $value):self {
		$datum = new InputDatum($value);
		return $this->add($key, $datum);
	}

	public function remove(string...$keys):self {
		foreach($keys as $key) {
			if(isset($this->parameters[$key])) {
				unset($this->parameters[$key]);
			}
		}

		return $this;
	}

	public function removeExcept(string...$keys):self {
		foreach($this->parameters as $key => $value) {
			if(!in_array($key, $keys)) {
				unset($this->parameters[$key]);
			}
		}

		return $this;
	}

	public function getKeys():array {
		return array_keys($this->parameters);
	}

	public function asArray():array {
		$array = [];

		foreach($this->parameters as $key => $value) {
			if($value instanceof MultipleInputDatum) {
				$array[$key] = $value->toArray();
			}
			else {
				$array[$key] = (string)$value;
			}
		}

		return $array;
	}
}