<?php
$conn = new mysqli('localhost', 'root', '', 'webapp');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT comments.comment, users.username FROM comments JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . htmlspecialchars($row['username']) . ":</strong> " . htmlspecialchars($row['comment']) . "</p>";
    }
} else {
    echo "No comments yet.";
}

$conn->close();
?>
