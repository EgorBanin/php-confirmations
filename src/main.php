<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//set_exception_handler(function (\Throwable $t) {
//	$rs = new \frm\Response(500, 'Internal server error');
//	$rs->send();
//	exit(1);
//});

$url =  $_SERVER["REQUEST_URI"]?? '';
$path = parse_url($url, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD']?? '';
$locator = sprintf('%s %s', strtolower($method), $path);

$route = '';
$params = [];
\frm\array_first([
	'~^get /$~' => 'index.php',
	'~^get /(?<dir>[^/]+)$~' => '{dir}/index.php',
	'~^get /(?<dir>[^/]+)/form$~' => '{dir}/form.php',
	'~^(?<method>\S+) /(?<dir>[^/]+)$~' => '{dir}/{method}.php',
], function (string $pattern, string $template) use($locator, &$route, &$params): bool {
	$match = (preg_match($pattern, $locator, $matches) === 1);
	if ($match) {
		$replaces = [];
		foreach ($matches as $name => $value) {
			if (is_string($name)) {
				$params[$name] = $value;
				$replaces['{' . $name . '}'] =  $value;
			}
		}
		$route = strtr($template, $replaces);

		return true;
	}

	return false;
});

if ($route === '') {
	$rs = new \frm\Response(404, 'Not found');
	$rs->send();
	exit(0);
}

$handlersDir = __DIR__ . '/http';
$handlerPath = realpath($handlersDir . '/' . $route);
if ($handlerPath === false) {
	$rs = new \frm\Response(404, 'Not found');
	$rs->send();
	exit(0);
}

if (!str_starts_with($handlerPath, $handlersDir)) {
	$rs = new \frm\Response(403, 'Forbidden');
	$rs->send();
	exit(0);
}

$handler = require $handlerPath;
$rs = $handler(...array_values($params));
$rs->send();
