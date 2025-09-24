
<?php
require_once 'db.php';
$result = $conn->query("SELECT username, email FROM users ORDER BY id ASC");
echo "<h2>Registered Users</h2>";
if ($result && $result->num_rows > 0) {
    echo "<ol>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['username']) . " (" . htmlspecialchars($row['email']) . ")</li>";
    }
    echo "</ol>";
} else {
    echo "<p>No users found.</p>";
}
$conn->close();