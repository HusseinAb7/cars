<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $car_id = $_POST['car_id'];
    $user_id = 1; // Replace with the actual user ID (e.g., from session)

    // Insert into the cart table
    $sql = "INSERT INTO cart (user_id, car_id) VALUES ('$user_id', '$car_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Car added to cart successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch cars from the database
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Collection</title>
</head>
<body>
    <h1>Choose Your Car</h1>
    <?php if ($result->num_rows > 0): ?>
        <form method="post" action="">
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Year</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?= $row['image_url'] ?>" alt="<?= $row['name'] ?>" width="100"></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['brand'] ?></td>
                            <td>$<?= $row['price'] ?></td>
                            <td><?= $row['year'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td>
                                <button type="submit" name="add_to_cart" value="Add to Cart">Add to Cart</button>
                                <input type="hidden" name="car_id" value="<?= $row['id'] ?>">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <p>No cars available at the moment.</p>
    <?php endif; ?>
</body>
</html>
