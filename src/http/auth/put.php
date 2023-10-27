<?php declare(strict_types=1);

$users = [
	'admin' => 'passw0rd',
];

return function() use ($users): \frm\Response {
	$rqBody = file_get_contents('php://input');
	parse_str($rqBody, $put);
	$login = $put['login']?? '';
	$password = $put['password']?? '';

	$userPassword = $users[$login]?? null;
	if ($userPassword === null || $userPassword !== $password) {
		return new \frm\Response(401, 'Неверный логин или пароль');
	}

	// login
	session_start();
	$_SESSION['isAuth'] = true;
	session_write_close();

	return \frm\Response::ok('');
};
