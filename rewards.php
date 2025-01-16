<?php
require 'db.php'; // Include the database connection file

// Function to earn points
function earnPoints($userId, $points, $description) {
    global $conn;

    // Add points to the user's total
    $updatePoints = $conn->prepare("UPDATE users SET total_points = total_points + ? WHERE id = ?");
    $updatePoints->bind_param("ii", $points, $userId);
    $updatePoints->execute();

    // Log the transaction
    $logTransaction = $conn->prepare("INSERT INTO transactions (user_id, points_earned, description) VALUES (?, ?, ?)");
    $logTransaction->bind_param("iis", $userId, $points, $description);
    $logTransaction->execute();
}

// Function to redeem points
function redeemPoints($userId, $points) {
    global $conn;

    // Check if user has enough points
    $checkPoints = $conn->prepare("SELECT total_points FROM users WHERE id = ?");
    $checkPoints->bind_param("i", $userId);
    $checkPoints->execute();
    $result = $checkPoints->get_result();
    $user = $result->fetch_assoc();

    if ($user['total_points'] >= $points) {
        // Deduct points
        $deductPoints = $conn->prepare("UPDATE users SET total_points = total_points - ? WHERE id = ?");
        $deductPoints->bind_param("ii", $points, $userId);
        $deductPoints->execute();

        // Log the transaction
        $logTransaction = $conn->prepare("INSERT INTO transactions (user_id, points_redeemed, description) VALUES (?, ?, 'Points Redeemed')");
        $logTransaction->bind_param("ii", $userId, $points);
        $logTransaction->execute();

        return "Points redeemed successfully!";
    } else {
        return "Not enough points to redeem.";
    }
}

// Function to get user points
function getUserPoints($userId) {
    global $conn;

    $query = $conn->prepare("SELECT total_points FROM users WHERE id = ?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    return $user['total_points'];
}
?>