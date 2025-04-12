<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

// Fetch user's events
$sql = "SELECT * FROM Events WHERE organizer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$events = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Event Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Hello, <?php echo htmlspecialchars($name); ?> 🎉</h1>
        <a href="logout.php" class="logout-btn">Logout</a>

        <h2>Your Events</h2>
        <a href="create_event.php" class="create-btn">+ Create New Event</a>

        <?php if ($events->num_rows > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($event = $events->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['title']); ?></td>
                <td><?php echo $event['start_time']; ?></td>
                <td><?php echo $event['end_time']; ?></td>
                <td><?php echo ucfirst($event['status']); ?></td>
                <td>
                    <a href="edit_event.php?id=<?php echo $event['event_id']; ?>">Edit</a> |
                    <a href="delete_event.php?id=<?php echo $event['event_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>No events found. Create one!</p>
        <?php endif; ?>
    </div>
</body>
</html>
