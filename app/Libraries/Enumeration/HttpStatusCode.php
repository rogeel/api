<?php
namespace App\Libraries\Enumeration;

class HttpStatusCode extends Enum {
	const OK = 200;
	const ACCEPTED = 202;
	const BAD_REQUEST = 400;
	const UNAUTHORIZED = 401;
	const FORBIDDEN = 403;
	const NOT_FOUND = 404;
	const INTERNAL_ERROR = 500;
}