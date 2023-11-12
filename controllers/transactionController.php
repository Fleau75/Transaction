<?php

require_once "../entities/AccountHolder.php";
require_once "../entities/FundTransfer.php";

function checkSessionActive() {
    if (!array_key_exists('active_user', $_SESSION)) {
        $_SESSION["feedback"] .= "<p>Log in required to view this page</p>";
        header("Location:./user-login");
        exit;
    }
}

checkSessionActive();

$selectedTransaction = null;
$userTransactions = [];

if (!empty($_GET["transaction_id"])) {
    $selectedTransaction = fetchTransactionDetails($_GET["transaction_id"]);
    
    if (is_null($selectedTransaction)) {
        $_SESSION["feedback"] .= "<p>Transaction not found or inaccessible</p>";
    }
}
else {
    $userId = $_SESSION["active_user"]["id"];
    $userTransactions = fetchUserTransactions($userId);
}

require "../layouts/transaction-details.php";

?>
