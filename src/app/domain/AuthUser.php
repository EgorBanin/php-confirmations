<?php declare(strict_types=1);

namespace app\domain;

class AuthUser implements User
{
	public function requestChanges(string $confirmationMethod, string $option, string $value): Confirmation
	{
		return new ConfirmationByCode(bin2hex(random_bytes(5)));
	}
}
