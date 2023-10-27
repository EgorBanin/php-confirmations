<?php declare(strict_types=1);

namespace frm;

function array_first(array $a, callable $func, $default = null) {
	foreach ($a as $k => $v) {
		if ($func($k, $v)) {
			return $k;
		}
	}

	return $default;
}

function ob_include(): string {
	extract(func_get_arg(1));
	ob_start();
	require func_get_arg(0);
	return ob_get_clean();
}