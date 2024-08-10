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

    </style>
</head>
<body>
    <div class="container">
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
            $duration = $_POST['duration'];
            $rental_date = date('Y-m-d');
            $return_date = date('Y-m-d', strtotime("+$duration days"));
            $status = 'Active';

            // Insert new rental
            $insert_query = "INSERT INTO rentals (user_id, rental_date, return_date, status) 
                             VALUES (:user_id, :rental_date, :return_date, :status)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute([
                ':user_id' => $user_id,
                ':rental_date' => $rental_date,
                ':return_date' => $return_date,
                ':status' => $status
            ]);

            $new_rental_id = $pdo->lastInsertId();

            echo "<p>New rental added successfully! Rental ID: $new_rental_id</p>";
        }

        // Fetch rent history for the logged-in user
        $user_id = 1; // Assuming you have a logged-in user ID

        // Handle search and sorting
        $search_title = isset($_GET['search_title']) ? $_GET['search_title'] : '';
        $search_status = isset($_GET['search_status']) ? $_GET['search_status'] : '';
        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'rental_date';
        $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';

        // Base query
        $query = "SELECT r.*, DATEDIFF(r.return_date, r.rental_date) AS rent_duration 
                  FROM rentals r
                  WHERE r.user_id = :user_id";

        // Add search conditions
        if (!empty($search_title)) {
            $query .= " AND r.id LIKE :search_title"; // Assuming 'id' is a unique identifier for the rental
        }
        if (!empty($search_status)) {
            $query .= " AND r.status = :search_status";
        }

        // Add sorting
        $query .= " ORDER BY $sort_by $sort_order";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if (!empty($search_title)) {
            $stmt->bindValue(':search_title', "%$search_title%", PDO::PARAM_STR);
        }
        if (!empty($search_status)) {
            $stmt->bindParam(':search_status', $search_status, PDO::PARAM_STR);
        }
        $stmt->execute();
        $rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display search and filter form
        echo "<h1>My Rent History</h1>";
        echo "<form method='get' class='search-form'>";
        echo "<input type='text' name='search_title' placeholder='Search by rental ID' value='" . htmlspecialchars($search_title) . "'>";
        echo "<select name='search_status'>";
        echo "<option value=''>All Statuses</option>";
        echo "<option value='Active'" . ($search_status == 'Active' ? " selected" : "") . ">Active</option>";
        echo "<option value='Returned'" . ($search_status == 'Returned' ? " selected" : "") . ">Returned</option>";
        echo "</select>";
        echo "<select name='sort_by'>";
        echo "<option value='rental_date'" . ($sort_by == 'rental_date' ? " selected" : "") . ">Rental Date</option>";
        echo "<option value='return_date'" . ($sort_by == 'return_date' ? " selected" : "") . ">Return Date</option>";
        echo "<option value='rent_duration'" . ($sort_by == 'rent_duration' ? " selected" : "") . ">Rent Duration</option>";
        echo "</select>";
        echo "<select name='sort_order'>";
        echo "<option value='DESC'" . ($sort_order == 'DESC' ? " selected" : "") . ">Descending</option>";
        echo "<option value='ASC'" . ($sort_order == 'ASC' ? " selected" : "") . ">Ascending</option>";
        echo "</select>";
        echo "<input type='submit' value='Search & Sort'>";
        echo "</form>";

        // Display rent history
        echo "<table>";
        echo "<tr><th>Rental ID</th><th>Rental Date</th><th>Return Date</th><th>Rent Duration</th><th>Status</th></tr>";
        foreach ($rentals as $rental) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($rental['id']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['rental_date']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['return_date']) . "</td>";
            echo "<td>" . htmlspecialchars($rental['rent_duration']) . " days</td>";
            echo "<td>" . htmlspecialchars($rental['status']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Prepare data for statistics
        $status_counts = array_count_values(array_column($rentals, 'status'));
        $duration_counts = array_count_values(array_column($rentals, 'rent_duration'));

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <div class="charts-container">
        <div class="chart">
            <canvas id="statusChart"></canvas>
        </div>
        <div class="chart">
            <canvas id="durationChart"></canvas>
        </div>
    </div>

    <script>
    // Status Chart
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_keys($status_counts)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($status_counts)); ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Rental Status Distribution'
                }
            }
        }
    });

    // Duration Chart
    new Chart(document.getElementById('durationChart'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($duration_counts)); ?>,
            datasets: [{
                label: 'Number of Rentals',
                data: <?php echo json_encode(array_values($duration_counts)); ?>,
                backgroundColor: '#4BC0C0'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Rental Duration Distribution'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>


    </div>
</body>
</html>
