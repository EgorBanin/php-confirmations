<?php declare(strict_types=1);

namespace app\domain;

class ENotAuthorized extends \Exception {
	public function __construct()
	{
		parent::__construct('not authorized', 1, null);
	}
}
