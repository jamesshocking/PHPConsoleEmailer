<?php

// composer include
require 'vendor/autoload.php';

define ("PROJECT_ROOT_PATH", __DIR__ . "/../");

// configuration
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// base controller
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";

// model
require_once PROJECT_ROOT_PATH . "/Model/Mail2RUModel.php";
require_once PROJECT_ROOT_PATH . "/Model/Mail2RUWebModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ContentModel.php";
require_once PROJECT_ROOT_PATH . "/Model/EmailHandlerModel.php";
require_once PROJECT_ROOT_PATH . "/Model/RecipientModel.php";

?>