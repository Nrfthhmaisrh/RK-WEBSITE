<?php
require 'rewards.php';

// Example user ID and purchase amount
$userId = 1; // Replace with logged-in user's ID
$purchaseAmount = 50; // Example purchase amount

// Calculate points (e.g., 1 point per $1 spent)
$points = $purchaseAmount;
$description = "Purchased coffee worth $$purchaseAmount";

// Earn points
earnPoints($userId, $points, $description);
echo "You earned $points points!";
?>