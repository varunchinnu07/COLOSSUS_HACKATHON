<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add or Update Tree</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Generate QR ocde for Tree</h1>
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="name">Tree Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="scientific_name">Scientific Name:</label>
                <input type="text" id="scientific_name" name="scientific_name" required>
            </div>

            <div class="form-group">
                <label for="family">Family:</label>
                <input type="text" id="family" name="family" required>
            </div>

            <div class="form-group">
                <label for="uses">Uses:</label>
                <textarea id="uses" name="uses" required></textarea>
            </div>

            <div class="form-group">
                <label for="required_nutrients">Nutrients:</label>
                <textarea id="required_nutrients" name="required_nutrients" required></textarea>
            </div>

            <div class="form-group">
                <label for="college_or_garden_name">College or Garden Name:</label>
                <input type="text" id="college_or_garden_name" name="college_or_garden_name" required>
            </div>

            <div class="form-group">
                <label for="part_of_college_or_garden">Part of College or Garden:</label>
                <input type="text" id="part_of_college_or_garden" name="part_of_college_or_garden" required>
            </div>

            <button type="submit">Submit</button>
        </form>
        <a class="view-link" href="list.php">View All Trees</a>
    </div>
</body>
</html>
