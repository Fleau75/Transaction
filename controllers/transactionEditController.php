<?php

require_once "../entities/Account.php";
require_once "../entities/LedgerEntry.php";

function confirmUserSession() {
    if (!hasActiveUserSession()) {
        $_SESSION["alert"] .= "<p>Authentication required to modify a ledger entry</p>";
        header("Location:../user-auth");
        exit;
    }
}

confirmUserSession();

if (!isset($_GET["entry_id"]) || $_GET["entry_id"] == '') {
    $_SESSION["alert"] .= "<p>Select a ledger entry for modification</p>";
    header("Location:../ledger-overview");
    exit;
}

$ledgerEntry = fetchLedgerEntryById($_GET["entry_id"]);

if (!$ledgerEntry) {
    $_SESSION["alert"] .= "<p>Invalid ledger entry selected</p>";
    header("Location:../ledger-overview");
    exit;
}

if ($ledgerEntry["account_id"] != $_SESSION["account"]["id"]) {
    $_SESSION["alert"] .= "<p>Modification access denied. Entry does not belong to your account.</p>";
    header("Location:../ledger-overview");
    exit;
}

require "../interfaces/editLedgerEntry.php";
?>
