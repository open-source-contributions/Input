<?php
namespace Gt\Input;

use DateTime;
use DateTimeInterface;
use Exception;
use Gt\Input\InputData\Datum\FileUpload;

trait InputValueGetter {
	public function get(string $key):?string {
		return $this->getString($key);
	}

	public function getValue(string $key):?string {
		return $this->getString($key);
	}

	public function getString(string $key):?string {
		return $this->getDatum($key);
	}

	public function getInt(string $key):?int {
		$value = $this->getString($key);
		if(is_null($value)) {
			return null;
		}

		return (int)$value;
	}

	public function getFloat(string $key):?float {
		$value = $this->getString($key);
		if(is_null($value)) {
			return null;
		}

		return (float)$value;
	}

	public function getBool(string $key):?bool {
		$value = $this->getString($key);
		if(is_null($value)) {
			return null;
		}

		return (bool)$value;
	}

	public function getFile(string $key):FileUpload {
		$file = $this->getDatum($key);
		if(!$file instanceof FileUpload) {
			throw new DataNotFileUploadException($key);
		}

		return $file;
	}

	public function getDateTime(string $key):DateTimeInterface {
		return $this->getAs($key, DateTime::class);
	}

	public function getAs(string $key, string $class) {
		try {
			$value = new $class($this[$key]);
			return $value;
		}
		catch(Exception $exception) {
			throw new DataNotCompatibleFormatException($key);
		}
	}
}