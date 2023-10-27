<?php declare(strict_types=1);

use app\domain;

return function (): \frm\Response {
	session_start();
	$isAuth = $_SESSION['isAuth']?? false;
	session_write_close();

	$rqBody = file_get_contents('php://input');
	parse_str($rqBody, $put);
	$option = $put['option']?? null;
	$value = $put['value']?? null;
	$confirmationMethod = $put['confirmationMethod']?? null;

	if ($option === null) {
		return new \frm\Response(400, 'option is required');
	}

	if ($value === null) {
		return new \frm\Response(400, 'value is required');
	}

	if ($confirmationMethod === null) {
		return new \frm\Response(400, 'confirmationMethod is required');
	}

	/** @var domain\User $user */
	$user = $isAuth? new domain\AuthUser() : new domain\UnknownUser;

	try {
		$confirmation = $user->requestChanges($confirmationMethod, $option, $value);
	} catch (domain\ENotAuthorized) {
		return new \frm\Response(401, 'authorization required');
	}

	$message = $confirmation->request();

	return \frm\Response::ok($message);
};
