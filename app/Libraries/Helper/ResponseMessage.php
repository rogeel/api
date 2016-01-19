<?php

namespace App\Libraries\Helper;

use App\Libraries\Enumeration\HttpStatusCode as StatusCode;
use Illuminate\Database;

use Lang;

class ResponseMessage {

	/*    General Json functions         */
	public static function returnJson($detail, $token = null, $apicode, $status, $stackTrace = null) {
		$content = array(
			'detail' => $detail,
			'token' => $token,
			'apiCode' => $apicode,
			'trace' => $stackTrace,
		);

		return \Response::json($content, $status);
	}

	public static function handleException($e) {

		// will sort out different types of returned jsons for each exception later
		if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
			return ResponseMessage::returnJson('', '', 'PAGE_NOT_FOUND_EXCEPTION', StatusCode::BAD_REQUEST);
		}
		if ($e instanceof \Illuminate\Database\QueryException) {
			return ResponseMessage::returnJson('', '', 'QUERY_EXCEPTION', StatusCode::BAD_REQUEST);
		}

		return ResponseMessage::returnJson('', '', 'EXCEPTION', StatusCode::BAD_REQUEST);
	}

//====================================================== Authentication Message ===================================================================

	public static function userLoginSuccess($user, $token) {
		return ResponseMessage::returnJson($user, $token, 'SYSTEM_ACCOUNT_FOUND', StatusCode::OK);
	}

	public static function userLoginFail() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.SYSTEM_ACCOUNT_NOT_FOUND'), '', 'SYSTEM_ACCOUNT_NOT_FOUND', StatusCode::BAD_REQUEST);
	}

	public static function userNoToken() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.TOKEN_NOT_PROVIDED'), '', 'TOKEN_NOT_PROVIDED', StatusCode::BAD_REQUEST);
	}

	public static function userLogoutNonExistingToken() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PROVIDED_TOKEN_NOT_IN_DATABASE'), '', 'PROVIDED_TOKEN_NOT_IN_DATABASE', StatusCode::BAD_REQUEST);
	}

	public static function userLogoutSuccess() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.LOGOUT_SUCCESS'), '', 'LOGOUT_SUCCESS', StatusCode::OK);
	}

	public static function userLoggedIn() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.LOGGED_IN'), '', 'LOGGED_IN', StatusCode::OK);
	}

	public static function invalidPermission() {
		return ResponseMessage::returnJson('INVALID PERMISSION', '', 'INVALID_PERMISSION', StatusCode::BAD_REQUEST);
	}

	public static function invalidToken() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_TOKEN'), '', 'INVALID_TOKEN', StatusCode::BAD_REQUEST);
	}

	public static function invalidCredentials() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_CREDENTIALS'), '', 'INVALID_CREDENTIALS', StatusCode::BAD_REQUEST);

	}

//====================================================== Product Message ===================================================================

	public static function productExist() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PRODUCT_EXIST'), '', 'PRODUCT_EXIST', StatusCode::BAD_REQUEST);
	}

	public static function productNameRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PRODUCT_NAME_REQUIRED'), '', 'PRODUCT_NAME_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function invalidProduct() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_PRODUCT'), '', 'INVALID_PRODUCT', StatusCode::BAD_REQUEST);
	}

//====================================================== Orders Message ===================================================================
	public static function billingAddressRequired(){
		return ResponseMessage::returnJson(Lang::get('SystemMessages.BILLING_ADDRESS_REQUIRED'), '', 'BILLING_ADDRESS_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function shippingAddressRequired(){
		return ResponseMessage::returnJson(Lang::get('SystemMessages.SHIPPING_ADDRESS_REQUIRED'), '', 'SHIPPING_ADDRESS_REQUIRED', StatusCode::BAD_REQUEST);
	}

//====================================================== Supplier Message ===================================================================


	public static function invalidSupplier() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_SUPPLIER'), '', 'INVALID_SUPPLIER', StatusCode::BAD_REQUEST);
	}

	public static function supplierNameRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.SUPPLIER_NAME_REQUIRED'), '', 'SUPPLIER_NAME_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function roleNameRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.ROLE_NAME_REQUIRED'), '', 'ROLE_NAME_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function rolePermissionRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.ROLE_PERMISSION_REQUIRED'), '', 'ROLE_PERMISSION_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function roleExists() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.ROLE_EXISTS'), '', 'ROLE_EXISTS', StatusCode::BAD_REQUEST);
	}

	public static function roleNotFound() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.ROLE_NOT_FOUND'), '', 'ROLE_NOT_FOUND', StatusCode::BAD_REQUEST);
	}

	public static function permissionNameRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PERMISSION_NAME_REQUIRED'), '', 'PERMISSION_NAME_REQUIRED', StatusCode::BAD_REQUEST);
	}

	public static function permissionNotFound() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PERMISSION_NOT_FOUND'), '', 'PERMISSION_NOT_FOUND', StatusCode::BAD_REQUEST);
	}

	public static function permissionTypeNotValid() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PERMISSION_TYPE_NOT_VALID'), '', 'PERMISSION_TYPE_NOT_VALID', StatusCode::BAD_REQUEST);
	}

	public static function permissionExist() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PERMISSION_EXIST'), '', 'PERMISSION_EXIST', StatusCode::BAD_REQUEST);
	}

	public static function userCreate($user) {
		return ResponseMessage::returnJson($user, '', 'SYSTEM_ACCOUNT_CREATED', StatusCode::OK);
	}


	public static function userCreateError() {
		return ResponseMessage::returnJson('', '', 'DUPLICATE_EMAIL', StatusCode::BAD_REQUEST);
	}

	// This error is generated when the user cannot be found in the system.
	// SSO -> In this case, the partner may have not imported the member's information to the system
	public static function userNotFound() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.USER_NOT_FOUND'), '', 'USER_NOT_FOUND', StatusCode::BAD_REQUEST);
	} // userNotFound

	// This error is generated when the user tries to hit the SSO SP without being authenticated
	public static function userNoAuthSSO() {
		return ResponseMessage::returnJson('', '', 'USER_NOT_AUTHENTICATED_SSO', StatusCode::BAD_REQUEST);
	} // userNoAuthSSO

	// This error is generated when the user tries to access the SSO route, but doesn't have a valid auth-source
	public static function invalidSSO() {
		return ResponseMessage::returnJson('', '', 'INVALID_SSO', StatusCode::BAD_REQUEST);
	} // invalidSSO

	public static function invalidPartner() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_PARTNER'), '', 'INVALID_PARTNER', StatusCode::BAD_REQUEST);
	}

	public static function invalidCustomer() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_CUSTOMER'), '', 'INVALID_CUSTOMER', StatusCode::BAD_REQUEST);
	}

	public static function no_data_input() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.NO_DATA_INPUT'), '', 'NO_DATA_INPUT', StatusCode::BAD_REQUEST);
	}

	public static function invalidProgram() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_PROGRAM'), StatusCode::BAD_REQUEST);
	}

	public static function invalidOrder() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_ORDER'), StatusCode::BAD_REQUEST);
	}

	public static function invalidAddress() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_ADDRESS'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCategory() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_CATEGORY'), StatusCode::BAD_REQUEST);
	}

	public static function invalidGroup() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_GROUP'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCategoryID() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_CATEGORY_ID'), StatusCode::BAD_REQUEST);
	}

	public static function nameRequired() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.NAME_REQUIRED'), '', Lang::get('SystemMessages.NAME_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function actionRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ACTION_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function domainRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.DOMAIN_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function nameOrDomainRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.NAME_DOMAIN_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function subdomainRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.SUBDOMAIN_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function templateRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.TEMPLATE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function incentiveTypeRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INCENTIVE_TYPE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function CountryRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.COUNTRY_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function typeRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.TYPE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function statusRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.STATUS_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function missingParameters() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.MISSING_PARAMETERS'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCampaign() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_CAMPAIGN'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCatalog() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_CATALOG'), StatusCode::BAD_REQUEST);
	}

	public static function invalidType() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_TYPE'), StatusCode::BAD_REQUEST);
	}

	public static function periodNotSupported() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.PERIOD_NOT_SUPPORTED'), StatusCode::BAD_REQUEST);
	}

	public static function changeTypeNotAllowed() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.CHANGE_TYPE_NOT_ALLOWED'), StatusCode::BAD_REQUEST);
	}

	public static function invalidTransaction() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_TRANSACTION'), StatusCode::BAD_REQUEST);
	}

	public static function memberRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.MEMBER_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function balanceRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.BALANCE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function noNotificationsSent() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.NO_NOTIFICATIONS_TO_SEND'), StatusCode::BAD_REQUEST);
	}

	public static function languageRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.LANGUAGE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function invalidEmailTemplate() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_EMAIL_TEMPLATE'), StatusCode::BAD_REQUEST);
	}

	public static function invalidWidget() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_WIDGET'), StatusCode::BAD_REQUEST);
	}

	public static function invalidBillingType() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_BILLING_TYPE'), StatusCode::BAD_REQUEST);
	}

	public static function periodRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.PERIOD_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function frequencyRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.FREQUENCY_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function programNameRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.PROGRAM_NAME_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function programIdRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.PROGRAM_ID_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function programKeyRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.PROGRAM_KEY_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function firstNameRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.FIRST_NAME_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function lastNameRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.LAST_NAME_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function employeeIdRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.EMPLOYEE_ID_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function roleRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ROLE_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function addressRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ADDRESS_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function addressCityRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ADDRESS_CITY_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function addressRegionRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ADDRESS_REGION_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function addressCountryRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ADDRESS_COUNTRY_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function addressPostalCodeRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.ADDRESS_POSTAL_CODE_REQUIRED'), StatusCode::BAD_REQUEST);

	}

	public static function modelNumberRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.MODEL_NUMBER_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function invalidTaxApiKey() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_TAX_API_KEY'), StatusCode::BAD_REQUEST);

	}

	public static function invalidMapper() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_MAPPER'), StatusCode::BAD_REQUEST);
	}

	public static function invalidWorkOrder() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_WORK_ORDER'), StatusCode::BAD_REQUEST);

	}

	public static function startDateRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.START_DATE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function endDateRequired() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.END_DATE_REQUIRED'), StatusCode::BAD_REQUEST);
	}

	public static function invalidRole() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_ROLE'), StatusCode::BAD_REQUEST);
	}

	// This error is generated when the file was uploaded, but failed
	public static function uploadedFileSaveFailed() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.UPLOADER_FILE_SAVE_FAILED'), '', 'UPLOADER_FILE_SAVE_FAILED', StatusCode::BAD_REQUEST);
	} // uploadedFileSaveFailed

	public static function invalidSystemUser() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_SYSTEM_USER'), StatusCode::BAD_REQUEST);
	}

	public static function invalidNoteType() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_NOTE_TYPE'), StatusCode::BAD_REQUEST);
	}

	public static function invalidEntityForNote() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_ENTITY_FOR_NOTE'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCreatorForNote() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.INVALID_CREATOR_FOR_NOTE'), StatusCode::BAD_REQUEST);
	}

	public static function nameNotUnique() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.NAME_NOT_UNIQUE'), '', Lang::get('SystemMessages.NAME_NOT_UNIQUE'), StatusCode::BAD_REQUEST);
	}

	public static function resourceRequiredForClone() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.RESOURCE_REQUIRED_FOR_CLONE'), '', Lang::get('SystemMessages.RESOURCE_REQUIRED_FOR_CLONE'), StatusCode::BAD_REQUEST);
	}

	public static function invalidResource() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_RESOURCE'), '', Lang::get('SystemMessages.INVALID_RESOURCE'), StatusCode::BAD_REQUEST);
	}

	public static function actionerIdRequiredForClone() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.ACTIONER_ID_REQUIRED_FOR_CLONE'), '', Lang::get('SystemMessages.ACTIONER_ID_REQUIRED_FOR_CLONE'), StatusCode::BAD_REQUEST);
	}

	public static function invalidCloner() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INVALID_CLONER'), '', Lang::get('SystemMessages.INVALID_CLONER'), StatusCode::BAD_REQUEST);
	}

    //====================================================== Campaign Message ===================================================================

    public static function noAvailableCampaigns() {
        return ResponseMessage::returnJson(Lang::get('SystemMessages.NO_AVAILABLE_CAMPAIGNS'), '', Lang::get('SystemMessages.NO_AVAILABLE_CAMPAIGNS'), StatusCode::BAD_REQUEST);
    }

    public static function noAvailableMembers() {
        return ResponseMessage::returnJson(Lang::get('SystemMessages.NO_AVAILABLE_MEMBERS'), '', Lang::get('SystemMessages.NO_AVAILABLE_MEMBERS'), StatusCode::BAD_REQUEST);
    }

    public static function updateNotAllowed() {
        return ResponseMessage::returnJson(Lang::get('SystemMessages.UPDATE_NOT_ALLOWED'), '', Lang::get('SystemMessages.UPDATE_NOT_ALLOWED'), StatusCode::BAD_REQUEST);
    }

	/**
	 * This error is generated when the file was uploaded, but didn't pass the validation
	 *
	 * @param string $_strMsg error message
	 *
	 * @return ResponseMessage
	 */
	public static function uploadFileInvalid($_strMsg) {
		//TODO VK: Might have to add translations to the $_strMsg
		return ResponseMessage::returnJson($_strMsg, '', 'UPLOADER_FILE_INVALID', StatusCode::BAD_REQUEST);
	} // uploadFileInvalid

	public static function success() {
		return ResponseMessage::returnJson('', '', Lang::get('SystemMessages.SUCCESS'), StatusCode::OK);
	}

	public static function fileIdDoesNotExist() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.FILE_ID_DOES_NOT_EXIST'), '', 'FILE_ID_DOES_NOT_EXIST', StatusCode::BAD_REQUEST);
	}

	public static function permissionDenied() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PERMISSION_DENIED'), '', 'PERMISSION_DENIED', StatusCode::BAD_REQUEST);
	}

	public static function incompleteRules() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.INCOMPLETE_RULES'), '', 'INCOMPLETE_RULES', StatusCode::BAD_REQUEST);
	}

	public static function placeholderCategoryMissing() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PLACEHOLDER_CATEGORY_MISSING'), '', 'PLACEHOLDER_CATEGORY_MISSING', StatusCode::BAD_REQUEST);
	}

	public static function placeholderNameMissing() {
		return ResponseMessage::returnJson(Lang::get('SystemMessages.PLACEHOLDER_NAME_MISSING'), '', 'PLACEHOLDER_NAME_MISSING', StatusCode::BAD_REQUEST);
	}
}