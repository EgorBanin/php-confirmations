<?php declare(strict_types=1);

return function(): \frm\Response {
	return \frm\Response::ok(\frm\ob_include(__DIR__ . '/form.phtml', []));
};