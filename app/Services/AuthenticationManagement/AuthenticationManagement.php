<?php

namespace App\Services\AuthenticationManagement;


use Hash;
use JWTAuth;
use App\Services\Management;

/**
 * Class AuthenticationManagement
 * @package ZIPPO\Services\AuthenticationManagement
 */
class AuthenticationManagement extends Management {
	/** @var \ZIPPO\Repositories\Authentication\AuthenticationRepository $repository */
	protected $repository;
	protected $permission;
	protected $actionList=['get'=>'read','post'=>'write','put'=>'edit','delete'=>'delete'] ;
	protected $actionName;

	public function __construct() {
		parent::__construct();

		// Checks put in place so that ide-helper works

	}



	public  function checkPermission(){
		$request = app('request');
		if (isset($request)) {
			$route = $request->route();
			if (isset($route)) {
				$action = $route->getAction();
				$controller = class_basename($action['controller']);
				list($controller, $action) = explode('Controller@', $controller);
				$this->permission = strtolower($controller);
				if (isset($this->actionList[strtolower($request->method())])) {
					$this->actionName = $this->actionList[strtolower($request->method())];
				}
			}
		}

		JWTAuth::parseToken();

		//echo $this->actionName.'.'.$this->permission;

		// and you can continue to chain methods
		$user = JWTAuth::parseToken()->authenticate();
		if ($user->can($this->actionName.'.'.$this->permission)) { // you can pass an id or slug
		    return true;
		}else{
			return false;
		}
	}

}
