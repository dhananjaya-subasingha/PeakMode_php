<?php
session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peakmode - Activity Tracker</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="activity_tracker.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->

</head>

<body style="font-family: 'Times New Roman', Times, serif; color: white; background-color: black;">
    <div class="grid-container">
        <div class="header">
            <div class="mini-grid">
                <div class="logo">
                    <img src="./images/logo1.PNG" width="150px">
                </div>
                <div class="quote">
                    <p style="text-align: right; margin-top:15px;">"Only those who dare to fail greatly can ever achieve
                        greatly!"</p>
                </div>
                <ul class="custom-navbar" style="padding: 0px ; margin: 0px;">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="health_calculator.html">Health Calculators</a></li>
                    <li><a href="workout_plans.html">Workout Plans</a></li>
                    <li><a href="activity_tracker.php">Activity Tracker</a></li>
                    <li><a href="about.html">About Us</a></li>
                    
                </ul>
            </div>
        </div>

        <div class="content tracker-content">
            <div class="tracker-bg-overlay"></div>
            <div class="container py-4 position-relative" style="z-index:2;">

                <!-- Entry Form -->
                <div class="tracker-card mb-4">
                    <h2 class="tracker-title"><i class="bi bi-activity me-2 text-danger"></i>Track your Daily Progress
                        &amp; reach peak</h2>
                    <form method="POST" action="save_activity.php">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="tracker-label">Date</label>
                            <input type="date" id="actDate" name = "date" class="tracker-input form-control">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="tracker-label">Exercise Type</label>
                            <select id="actType" name = "type" class="tracker-input form-select">
                                <option value="" disabled selected>Select exercise type</option>
                                <option value="Running">Running</option>
                                <option value="Walking">Walking</option>
                                <option value="Cycling">Cycling</option>
                                <option value="Swimming">Swimming</option>
                                <option value="Weight Training">Weight Training</option>
                                <option value="HIIT">HIIT</option>
                                <option value="Yoga">Yoga</option>
                                <option value="Calisthenics">Calisthenics</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="tracker-label">Duration (minutes)</label>
                            <input type="number" name = "duration" id="actDuration" class="tracker-input form-control"
                                placeholder="e.g. 45" min="1">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="tracker-label">Steps</label>
                            <input type="number" id="actSteps" name = "steps" class="tracker-input form-control"
                                placeholder="e.g. 8000" min="0">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="tracker-label">Calories Burned</label>
                            <input type="number" id="actCalories" name = "calories" class="tracker-input form-control"
                                placeholder="e.g. 350" min="0">
                        </div>
                        <div class="col-12 col-md-4 d-flex align-items-end">
                            <button type = "submit" class="tracker-btn w-100">
                                <i class="bi bi-plus-circle-fill me-2"></i>Enter
                            </button>
                        </div>
                    </div>
</form>
                    <p id="formError" class="text-danger mt-2 mb-0" style="display:none;"></p>
                </div>

                <!-- Summary Stats -->
                <div class="row g-3 mb-4" id="statsRow">
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-list-check stat-icon"></i>
                            <div class="stat-value" id="statSessions">0</div>
                            <div class="stat-label">Sessions</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-clock-fill stat-icon"></i>
                            <div class="stat-value" id="statMinutes">0</div>
                            <div class="stat-label">Total Minutes</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-lightning-fill stat-icon"></i>
                            <div class="stat-value" id="statCalories">0</div>
                            <div class="stat-label">Total Calories</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-geo-alt-fill stat-icon"></i>
                            <div class="stat-value" id="statSteps">0</div>
                            <div class="stat-label">Total Steps</div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="tracker-card mb-4">
                    <h5 class="tracker-subtitle mb-3"><i class="bi bi-bar-chart-fill me-2 text-danger"></i>Progress
                        Chart</h5>
                    <div class="chart-tabs mb-3">
                        <button class="chart-tab active" data-metric="duration">Duration</button>
                        <button class="chart-tab" data-metric="calories">Calories</button>
                        <button class="chart-tab" data-metric="steps">Steps</button>
                    </div>
                    <canvas id="progressChart" height="100"></canvas>
                </div>

                <!-- Log Table -->
                <div class="tracker-card">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="tracker-subtitle mb-0"><i class="bi bi-journal-text me-2 text-danger"></i>Activity
                            Log</h5>
                        <button id="btnClear" class="clear-btn"><i class="bi bi-trash3-fill me-1"></i>Clear All</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table tracker-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Duration (min)</th>
                                    <th>Steps</th>
                                    <th>Calories</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
// include("includes/db.php");

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM activities WHERE user_id='$user_id' ORDER BY date DESC");

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['type']}</td>
                <td>{$row['duration']}</td>
                <td>{$row['steps']}</td>
                <td>{$row['calories']}</td>
                <td>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr>
            <td colspan='6' class='text-center text-muted'>No entries yet</td>
          </tr>";
}
?>
</tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer">
            <img src="./images/footer_logo.png" width="200px">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="activity_tracker.js"></script> -->
</body>

</html>