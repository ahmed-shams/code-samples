<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
$objAdmin = new Admin();

$Preference = $_REQUEST["Pref"];

$objAdmin->SavePreference($Preference);

?>