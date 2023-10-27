<?php declare(strict_types=1);

namespace app\domain;

// just put code to a specific file
class  FileTransport implements Transport
{
	public function __construct(
		private string $file,
	)
	{
	}

	public function send(string $msg): void
	{
		file_put_contents($this->file, $msg);
	}
}
