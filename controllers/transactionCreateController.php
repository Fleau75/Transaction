<?php

require_once "../database/Member.php";
require_once "../database/FinanceRecord.php";

if (!isLoggedInMember()) {
    $_SESSION["feedbackMessage"] .= "<p>Access restricted. Please sign in to proceed.</p>";
    header("Location:../user-login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $inputValid = true;

    if (empty($_POST["transaction_label"])) {
        $_SESSION["feedbackMessage"] .= "<p>Transaction label is required.</p>";
        $inputValid = false;
    }

    if (empty($_POST["transaction_amount"])) {
        $_SESSION["feedbackMessage"] .= "<p>Enter the transaction amount.</p>";
        $inputValid = false;
    } elseif (!ctype_digit($_POST["transaction_amount"])) {
        $_SESSION["feedbackMessage"] .= "<p>Amount should be a numeric value.</p>";
        $inputValid = false;
    }

    if ($inputValid) {
        createNewFinanceEntry($_SESSION["member"]["id"], $_POST["transaction_label"], round($_POST["transaction_amount"]));
        header("Location:.././view-transactions");
        exit;
    }
}

require "../interfaces/newTransactionForm.php";

?>
