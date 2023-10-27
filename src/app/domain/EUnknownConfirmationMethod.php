<?php declare(strict_types=1);

namespace app\domain;

class EUnknownConfirmationMethod extends \Exception {
	public function __construct(string $method)
	{
		parent::__construct('unknown confirmation method ' . $method, 1, null);
	}
}