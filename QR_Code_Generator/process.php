<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $scientific_name = $_POST['scientific_name'];
    $family = $_POST['family'];
    $uses = $_POST['uses'];
    $required_nutrients = $_POST['required_nutrients'];
    $college_or_garden_name = $_POST['college_or_garden_name'];
    $part_of_college_or_garden = $_POST['part_of_college_or_garden'];

    // Prepare data to encode into QR code
    $qrData = "ID: [auto]\nName: $name\nScientific Name: $scientific_name\nFamily: $family\nUses: $uses\nRequired Nutrients: $required_nutrients\nCollege/Garden: $college_or_garden_name\nPart: $part_of_college_or_garden";

    // Generate QR code using goqr.me
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData) . "&size=200x200";

    // Insert into database
    $sql = "INSERT INTO trees (name, scientific_name, family, uses, required_nutrients, college_or_garden_name, part_of_college_or_garden, qr_code_url) 
            VALUES ('$name', '$scientific_name', '$family', '$uses', '$required_nutrients', '$college_or_garden_name', '$part_of_college_or_garden', '$qrCodeUrl')";

    if ($conn->query($sql) === TRUE) {
        echo "Tree details added successfully. <br>";
        echo "<a href='list.php'>Go back to list</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
