<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to submit a comment.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    $conn = new mysqli('localhost', 'root', '', 'webapp');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO comments (user_id, comment) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $comment);

    if ($stmt->execute()) {
        echo "Comment submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
