<?php declare(strict_types=1);

namespace app\repositories;

use app\domain\Confirmation;
use app\domain;

class Confirmations implements domain\ConfirmationsRepository
{

	public function get($id): ?Confirmation
	{
		return null;
	}

}
