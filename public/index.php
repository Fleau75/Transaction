<?php

session_start();

$currentPath = $_SERVER['REQUEST_URI'];
$currentPath = explode("example", $currentPath)[1];
$currentPath = explode("?", $currentPath)[0];
$currentPath = trim($currentPath, "/public");

$httpMethod = $_SERVER['REQUEST_METHOD'];

switch ($currentPath) {
    case '':
        require '../handlers/mainPageHandler.php';
        break;

    case 'signin':
        require '../handlers/signinHandler.php';
        break;

    case 'signup':
        require '../handlers/signupHandler.php';
        break;

    case 'signout':
        require '../handlers/signoutHandler.php';
        break;

    case 'financials':
        require '../handlers/financialOverviewHandler.php';
        break;

    case 'financials/new':
        require '../handlers/financialCreateHandler.php';
        break;

    case 'financials/modify':
        require '../handlers/financialModifyHandler.php';
        break;

    case 'financials/apply-update':
        require '../handlers/financialUpdateHandler.php';
        break;

    case 'financials/remove':
        require '../handlers/financialDeleteHandler.php';
        break;

    default:
        require '../handlers/mainPageHandler.php';
        break;
}
?>
