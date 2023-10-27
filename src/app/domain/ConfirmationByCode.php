<?php declare(strict_types=1);

namespace app\domain;

class ConfirmationByCode implements Confirmation {

	public function __construct(
		private string $code,
		private Transport $transport,
	){}

	public function confirm(): bool
	{
		// TODO: Implement confirm() method.
	}

	public function request(): string
	{
		$this->transport->send('secret code ' . $this->code);

		return "Укажите секретный код";
	}
}
