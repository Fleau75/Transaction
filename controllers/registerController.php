<?php

include_once "../models/Client.php";
include_once "../models/MoneyMovement.php";

function validateUserSession() {
    if (!isset($_SESSION['loggedInClient'])) {
        $_SESSION["alertMessage"] .= "<p>Authentication needed to proceed</p>";
        header("Location:./client-signin");
        exit;
    }
}

validateUserSession();

$currentTransactionView = null;
$listOfClientTransactions = [];

if (isset($_GET["transact_id"]) && $_GET["transact_id"] != '') {
    $currentTransactionView = retrieveTransaction($_GET["transact_id"]);
    
    if ($currentTransactionView === null) {
        $_SESSION["alertMessage"] .= "<p>Unable to locate specified transaction</p>";
    }
}
else {
    $clientId = $_SESSION['loggedInClient']["id"];
    $listOfClientTransactions = getClientTransactionHistory($clientId);
}

include "../templates/transaction-overview.php";

?>
