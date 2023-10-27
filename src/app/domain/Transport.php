<?php declare(strict_types=1);

namespace app\domain;

interface Transport {
	public function send(string $msg): void;
}
