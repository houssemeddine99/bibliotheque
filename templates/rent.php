<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rental System</title>
    <style>
        /* Keep your existing styles */
        
        /* Add styles for the new rental form */
        .rental-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .rental-form input, .rental-form select {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
        }
        
        .rental-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        
        .rental-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    // Configuration for the database connection
    $dsn = 'mysql:host=localhost;dbname=bibliotheque';
    $username = 'root';
    $password = '';

    try {
        // Create a PDO instance
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Handle new rental submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_rental'])) {
            $user_id = 1; // Assuming you have a logged-in user ID
            $book_id = $_POST['book_id'];
            $rental_date = date('Y-m-d');
            $return_date = date('Y-m-d', strtotime('+' . $_POST['duration'] . ' days'));
            $status = 'Active';

            $insert_query = "INSERT INTO rentals (user_id, book_id, rental_date, return_date, status) 
                             VALUES (:user_id, :book_id, :rental_date, :return_date, :status)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute([
                ':user_id' => $user_id,
                ':book_id' => $book_id,
                ':rental_date' => $rental_date,
                ':return_date' => $return_date,
                ':status' => $status
            ]);

            echo "<p>New rental added successfully!</p>";
        }

        // Display new rental form
        echo "<div class='rental-form'>";
        echo "<h2>Add New Rental</h2>";
        echo "<form method='post'>";
        echo "<input type='number' name='book_id' placeholder='Book ID' required>";
        echo "<select name='duration' required>";
        echo "<option value='1'>1 Day</option>";
        echo "<option value='2'>2 Days</option>";
        echo "<option value='3'>3 Days</option>";
        echo "<option value='4'>4 Days</option>";
        echo "<option value='7'>7 Days</option>";
        echo "</select>";
        echo "<input type='submit' name='add_rental' value='Add Rental'>";
        echo "</form>";
        echo "</div>";

        // Fetch rent history for the logged-in user
        $user_id = 1; // Assuming you have a logged-in user ID

        // Get the selected duration from the form, default to 'all' if not set
        $selected_duration = isset($_GET['duration']) ? $_GET['duration'] : 'all';
        
        // Base query
        $query = "SELECT *, DATEDIFF(return_date, rental_date) AS rent_duration 
                  FROM rentals 
                  WHERE user_id = :user_id";

        // Add duration filter if a specific duration is selected
        if ($selected_duration !== 'all') {
            $query .= " AND DATEDIFF(return_date, rental_date) = :duration";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if ($selected_duration !== 'all') {
            $stmt->bindParam(':duration', $selected_duration, PDO::PARAM_INT);
        }
        $stmt->execute();
        $rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display duration filter form
        echo "<form method='get'>";
        echo "<select name='duration'>";
        echo "<option value='all'" . ($selected_duration == 'all' ? " selected" : "") . ">All Durations</option>";
        echo "<option value='1'" . ($selected_duration == '1' ? " selected" : "") . ">1 Day</option>";
        echo "<option value='2'" . ($selected_duration == '2' ? " selected" : "") . ">2 Days</option>";
        echo "<option value='3'" . ($selected_duration == '3' ? " selected" : "") . ">3 Days</option>";
        echo "<option value='4'" . ($selected_duration == '4' ? " selected" : "") . ">4 Days</option>";
        echo "<option value='7'" . ($selected_duration == '7' ? " selected" : "") . ">7 Days</option>";
        echo "</select>";
        echo "<input type='submit' value='Filter'>";
        echo "</form>";

        // Display rent history
        echo "<h1>My Rent History</h1>";
        echo "<table>";
        echo "<tr><th>Book ID</th><th>Rental Date</th><th>Return Date</th><th>Rent Duration</th><th>Status</th></tr>";
        foreach ($rentals as $rental) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($rental['book_id']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['rental_date']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['return_date']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['rent_duration']) . " days</td>";
            echo "<td>" . htmlspecialchars($rental['status']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<br>Error Code: " . $e->getCode();
        echo "<br>SQL State: " . $e->errorInfo[0];
        echo "<br>Error Info: " . print_r($e->errorInfo, true);
    }
    ?>
</body>
</html>