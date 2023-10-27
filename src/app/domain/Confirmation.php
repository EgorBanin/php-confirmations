<?php declare(strict_types=1);

namespace app\domain;

interface Confirmation
{
	public function request(): string;

	public function confirm(): bool;
}
