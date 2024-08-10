
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Charts / Chart.js - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
  <!-- Chart.js Library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
      background-color: #ff6c80;
    }

    #rental-chart {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    }
  </style>

</head>

<body>
  

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="charts-chartjs.html">
          <i class="bi bi-bar-chart"></i>
          <span>Charts</span>
        </a>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Chart.js</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Chart.js</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    </section>
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
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    const ctx = document.getElementById('rental-chart').getContext('2d');
    const rentalChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Model 1', 'Model 2', 'Model 3'],
        datasets: [{
          label: 'Number of Rentals',
          data: [12, 19, 3],
          backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
          borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const rentalForm = document.getElementById('rentalForm');
    rentalForm.addEventListener('submit', function (event) {
      event.preventDefault();
      const carModel = document.getElementById('carModel').value;
      const rentalData = rentalChart.data.datasets[0].data;
      if (carModel === 'model1') {
        rentalData[0]++;
      } else if (carModel === 'model2') {
        rentalData[1]++;
      } else if (carModel === 'model3') {
        rentalData[2]++;
      }
      rentalChart.update();
    });
  </script>

</body>

</html>
