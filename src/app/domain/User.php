<?php declare(strict_types=1);

namespace app\domain;

interface User {
	/**
	 * @return Confirmation
	 * @throws ENotAuthorized
	 * @throws EUnknownConfirmationMethod
	 */
	public function requestChanges(string $confirmationMethod, string $option, string $value): Confirmation;
}
