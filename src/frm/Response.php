<?php declare(strict_types=1);

namespace frm;

class Response {

	public function __construct(
		private int $code,
		private string $body,
	){}

	public static function ok(string $body): Response {
		return new Response(200, $body);
	}

	public function send(): void {
		http_response_code($this->code);
		echo $this->body;
	}
}