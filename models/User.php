<?php 

function checkClientSession() {
    return isset($_SESSION["client"]) ? true : false;
}

function fetchAccountByEmail($email) {
    $accountData = null;

    $pdo = new PDO("mysql:dbname=finance_db;host=localhost", "user", "pass");
    $sql = "SELECT * FROM account_holders WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() == 1) {
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $accountData;
}

function addNewAccount($accountName, $emailAddress, $pwd) {
    $encryptedPassword = password_hash($pwd, PASSWORD_DEFAULT);

    $pdo = new PDO("mysql:dbname=finance_db;host=localhost", "user", "pass");
    $sql = "INSERT INTO account_holders (name, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$accountName, $emailAddress, $encryptedPassword]);
}
?>
