<?php


require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/Mail2RUController.php";

$objMailController = new Mail2RUController();
$objMailController->emailAction();

print("Finished...");
?>




