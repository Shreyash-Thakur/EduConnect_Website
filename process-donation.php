<?php
// Enable errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to MySQL (XAMPP default credentials)
$host = 'localhost';
$db = 'educonnect';  // change to your actual DB name
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$amount = $_POST['amount'] ?? 0;
$message = $_POST['message'] ?? '';

// Validate input
if (empty($name) || empty($email) || $amount <= 0) {
    die("Please fill all required fields correctly.");
}

// Insert into DB
$stmt = $pdo->prepare("INSERT INTO donations (name, email, amount, message) VALUES (:name, :email, :amount, :message)");
$stmt->execute([
    'name' => $name,
    'email' => $email,
    'amount' => $amount,
    'message' => $message
]);

// Redirect or confirm
echo "<script>alert('Thank you for your donation!'); window.location.href='index.php';</script>";
?>
