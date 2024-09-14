<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM trees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Tree deleted successfully. <br>";
    echo "<a href='list.php'>Go back to list</a>";
} else {
    echo "Error deleting tree: " . $conn->error;
}

$conn->close();
?>
