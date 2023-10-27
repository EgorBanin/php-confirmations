<?php declare(strict_types=1);

namespace app\domain;

class UnknownUser implements User {
	public function requestChanges(string $confirmationMethod, string $option, string $value): Confirmation
	{
		throw new ENotAuthorized();
	}
}
