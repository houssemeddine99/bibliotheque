<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rental System</title>
    <style>
        body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 85%;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    color: #333;
    text-align: center;
    font-weight: 700;
    margin-bottom: 30px;
}

h1 {
    font-size: 2.5em;
    letter-spacing: 1px;
}

h2 {
    font-size: 2em;
    letter-spacing: 0.5px;
}

/* Rental Form */
.rental-form {
    background-color: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.rental-form input, .rental-form select {
    margin-bottom: 15px;
    padding: 12px;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 1em;
}

.rental-form input[type="submit"] {
    background-color: #FF4C60;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 1em;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}

.rental-form input[type="submit"]:hover {
    background-color: #ff2b3d;
}

/* Filter Form */
form[method="get"] {
    margin-bottom: 30px;
    text-align: center;
}

form[method="get"] select {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-right: 10px;
    box-sizing: border-box;
    font-size: 1em;
}

form[method="get"] input[type="submit"] {
    padding: 12px 25px;
    background-color: #FF4C60;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s ease;
}

form[method="get"] input[type="submit"]:hover {
    background-color: #ff2b3d;
}

/* Rent History Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

table th {
    background-color: #FF4C60;
    color: white;
    font-weight: 700;
    text-transform: uppercase;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

p {
    color: #FF4C60;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
    font-size: 1.2em;
}
.home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FF4C60;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .home-button:hover {
            background-color: #ff2b3d;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
    include_once './../controller/RentalController.php';

    $controller = new RentalController();


    // Fetch rent history for the logged-in user
    $user_id = 1;
    $selected_duration = isset($_GET['duration']) ? $_GET['duration'] : 'all';
    $rentals = $controller->getRentals($user_id, $selected_duration);

    echo '<a href="../templates/index.php" class="home-button">Return to Home</a>'; // Adjust "index.html" to your home page URL
    echo '<a href="rent_document.php" class="home-button">Rent a Document</a>';

    // Display filter form
    echo "<h1>My Rent History</h1>";
    echo "<form method='get'>";
    echo "<select name='duration'>";
    echo "<option value='all'" . ($selected_duration == 'all' ? " selected" : "") . ">All Durations</option>";
    echo "<option value='1'" . ($selected_duration == '1' ? " selected" : "") . ">1 Day</option>";
    echo "<option value='2'" . ($selected_duration == '2' ? " selected" : "") . ">2 Days</option>";
    echo "<option value='3'" . ($selected_duration == '3' ? " selected" : "") . ">3 Days</option>";
    echo "<option value='4'" . ($selected_duration == '4' ? " selected" : "") . ">4 Days</option>";
    echo "</select>";
    echo "<input type='submit' value='Filter'>";
    echo "</form>";

    // Display rent history
    echo "<table>";
    echo "<tr><th>Rental ID</th><th>Book ID</th><th>Rental Date</th><th>Return Date</th><th>Rent Duration</th><th>Status</th></tr>";
    foreach ($rentals as $rental) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($rental['id']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['book_id']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['rental_date']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['return_date']) . "</td>";
        echo "<td>" . htmlspecialchars($rental['rent_duration']) . " days</td>";
        echo "<td>" . htmlspecialchars($rental['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    </div>
</body>
</html>