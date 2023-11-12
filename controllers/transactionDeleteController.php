<?php

require_once "../data/Client.php";
require_once "../data/Payment.php";

function ensureClientLoggedIn() {
    if (!clientSessionActive()) {
        $_SESSION["notification"] .= "<p>Login required to proceed with deletion</p>";
        header("Location:../signin");
        exit;
    }
}

ensureClientLoggedIn();

if (!isset($_GET["transactionRef"]) || $_GET["transactionRef"] == '') {
    $_SESSION["notification"] .= "<p>Select a payment record to remove</p>";
    header("Location:../all-payments");
    exit;
}

$paymentDetails = findPaymentById($_GET["transactionRef"]);

if (!$paymentDetails) {
    $_SESSION["notification"] .= "<p>Invalid payment record specified</p>";
    header("Location:../all-payments");
    exit;
}

if ($paymentDetails["clientId"] != $_SESSION["client"]["id"]) {
    $_SESSION["notification"] .= "<p>Unauthorized deletion attempt blocked</p>";
    header("Location:../all-payments");
    exit;
}

removePayment($_GET["transactionRef"]);

$_SESSION["notification"] .= "<p>Payment record successfully deleted</p>";
header("Location:../all-payments");
exit;
?>
