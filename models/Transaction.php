<?php 

function fetchPaymentDetailsById($paymentId) {
    $paymentData = null;

    $pdo = new PDO("mysql:dbname=finance;host=localhost", "admin", "password");
    $sql = "SELECT p.id, p.account_id, p.title, p.value, p.modified_time, u.user_name FROM payments p JOIN accounts u ON p.account_id = u.id WHERE p.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paymentId]);

    if ($stmt->rowCount() == 1) {
        $paymentData = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $paymentData;
}

function removePayment($paymentId) {
    $pdo = new PDO("mysql:dbname=finance;host=localhost", "admin", "password");
    $sql = "DELETE FROM payments WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paymentId]);
}

function retrieveAllUserPayments($userId) {
    $pdo = new PDO("mysql:dbname=finance;host=localhost", "admin", "password");
    $sql = "SELECT p.id, p.title, p.value, p.modified_time, u.user_name FROM payments p JOIN accounts u ON p.account_id = u.id WHERE u.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);

    $allUserPayments = array_reverse($stmt->fetchAll(PDO::FETCH_ASSOC));

    return $allUserPayments;
}

function createPaymentRecord($userId, $title, $value) {
    $pdo = new PDO("mysql:dbname=finance;host=localhost", "admin", "password");
    $sql = "INSERT INTO payments (account_id, title, value) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $title, $value]);
}

function modifyPayment($title, $value, $paymentId) {
    $pdo = new PDO("mysql:dbname=finance;host=localhost", "admin", "password");
    $sql = "UPDATE payments SET title = ?, value = ?, modified_time = current_timestamp WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $value, $paymentId]);
}
?>
