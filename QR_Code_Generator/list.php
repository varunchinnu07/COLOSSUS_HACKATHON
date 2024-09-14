<?php
include 'config.php';

$sql = "SELECT * FROM trees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tree List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Scientific Name</th>
                    <th>Family</th>
                    <th>Uses</th>
                    <th>Required Nutrients</th>
                    <th>College/Garden</th>
                    <th>Part</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['scientific_name']; ?></td>
                        <td><?php echo $row['family']; ?></td>
                        <td><?php echo $row['uses']; ?></td>
                        <td><?php echo $row['required_nutrients']; ?></td>
                        <td><?php echo $row['college_or_garden_name']; ?></td>
                        <td><?php echo $row['part_of_college_or_garden']; ?></td>
                        <td><img src="<?php echo $row['qr_code_url']; ?>" alt="QR Code"></td>
                        <td>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a><br>
                            <a href="<?php echo $row['qr_code_url']; ?>" download>Download QR Code</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="view-link" href="index.php">Add New Tree</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
