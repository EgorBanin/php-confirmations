<?php declare(strict_types=1);

namespace app\domain;

interface ConfirmationsRepository {
	public function get($id): ?Confirmation;
}
