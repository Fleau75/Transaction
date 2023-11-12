<?php

require_once "../data/Member.php";
require_once "../data/FinanceEntry.php";

function verifyMemberSession() {
    if (!isMemberLoggedIn()) {
        $_SESSION["feedback"] .= "<p>Session required to modify finance data</p>";
        header("Location:../member-login");
        exit;
    }
}

verifyMemberSession();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    if (empty($_POST["entry_name"])) {
        $_SESSION["feedback"] .= "<p>Entry name is mandatory</p>";
        header("Location:./modify?id=" . $_POST["entry_id"]);
        exit;
    }

    if (empty($_POST["value"]) || !is_numeric($_POST["value"])) {
        $_SESSION["feedback"] .= "<p>Valid numeric value required for entry</p>";
        header("Location:./modify?id=" . $_POST["entry_id"]);
        exit;
    }

    modifyFinanceEntry($_POST["entry_name"], round($_POST["value"]), (int)$_POST["entry_id"]);
    header("Location:../finance-overview");
    exit;
}

?>
