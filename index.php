<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peakmode home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="grid-container">
        <div class="header">
            <div class="mini-grid">
                <div class="logo">
                    <img src="./images/logo1.PNG" width="150px">
                </div>
                <div class="quote">
                    <p style="text-align : right">"Only those who dare to fail greatly can ever achieve greatly!"</p>
                </div>

                <ul class="custom-navbar">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="health_calculator.html">Health Calculators</a></li>
                    <li><a href="workout_plans.html">Workout Plans</a></li>
                    <li><a href="activity_tracker.php">Activity Tracker</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="auth/logout.php">Logout</a></li>
                    <?php else: ?>
                    <li><a href="auth/login.php">Login</a></li>
                    <li><a href="auth/register.php">Register</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="slider">
                <img src = "./images/barbell.png">
                <img src = "./images/randy.png">
                <img src = "./images/vaquer.png">
            </div>
            <p class = "text">
                PeakMode is an interactive fitness web application designed to support individuals<br>
                 of all ages and fitness levels. Whether the goal is muscle building, weight loss,<br>
                  weight gain, calisthenics training, or improving cardiovascular endurance,<br> PeakMode provides essential tools to track progress, calculate health metrics, and stay motivated.<br>
                  The platform promotes a balanced and data-driven approach to personal fitness
            </p>
        </div>
        <div class="footer">
            <img src = "./images/footer_logo.png" width="200px">
        </div>
    </div>
</body>

</html>