<?php
include 'db.php'; 

$supportQuestion = "How can I reset my password?";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['issue'])) {
    $issueDescription = $_POST['issue'];

    
    $stmt = $conn->prepare("INSERT INTO issues (description) VALUES (?)");
    $stmt->bind_param("s", $issueDescription);

   
    if ($stmt->execute()) {
        echo "<script>alert('Your issue has been submitted!');</script>"; 
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>"; 
    }


    $stmt->close();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    
<header>
    <div class="logo_div">
        <div id="logoToggle" class="logo">
            <h1 >Cav Grey Airlines</h1>
        </div>

        <div class="button_div">
            <label for="checkbutton" class="checkbtn">
                <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
            </label>
        </div>


    </div>
        
    <nav class="Navbar_top" id="navBar">
        <div class="dropdown">
            <a href="index.php" class="dropbtn">Home</a>
        </div>
        <div class="dropdown">
            <a href="#services" class="dropbtn">Our Service</a>
            <div class="dropdown-content">
                <a href="domestic.html">Domestic</a>
                <a href="international.html">International</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="book.php" class="dropbtn">Book</a>
        </div>
        <div class="dropdown">
            <a href="#map" class="dropbtn">Map</a>
            <div class="dropdown-content">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.97889999999!2d28.322352!3d-15.387525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1940f5a7b5f5f5f5%3A0x5f5f5f5f5f5f5f5f!2sLusaka%2C%20Zambia!5e0!3m2!1sen!2szm!4v1633024000000!5m2!1sen!2szm" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

    </nav>
</header>

<div class="container">
        <div class="support">
            <h2>We're Here to Help You!</h2>
            <p>Have an issue or question? Describe it below, and we'll assist you as quickly as possible!</p>
            <form id="issueForm" method="POST" action="">
                <div class="group">
                    <label for="issueDescription">Describe your issue:</label>
                    <textarea class="input" name="issue" id="issueDescription" rows="4" placeholder="Enter your issue here..." required></textarea>
                </div>
                <button type="submit" class="btn primary">Send Issue</button>
            </form>
        </div>

        <div class="grid">
            <?php
            $problems = [
                ['title' => 'Delays, cancellations and refunds', 'description' => 'Find out about delays and our refund policies.'],
                ['title' => 'Lost baggage', 'description' => 'Learn how to report and track lost baggage.'],
                ['title' => 'Vouchers', 'description' => 'Information on redeeming travel vouchers.'],
                ['title' => 'Contacts', 'description' => 'Access our contact information and FAQs.'],
                ['title' => 'Flight status', 'description' => 'Check your flight status here.'],
                ['title' => 'Assistance', 'description' => 'We provide assistance for travelers with disabilities.'],
                ['title' => 'Medical', 'description' => 'Guidelines for traveling with medical conditions.'],
                ['title' => 'Travel help', 'description' => 'Explore available travel assistance services.'],
                ['title' => 'Check-in', 'description' => 'Information on check-in and boarding procedures.']
            ];

            foreach ($problems as $problem) {
                echo '<div class="card">';
                echo '    <div class="content">';
                echo '        <h5 class="title">' . $problem['title'] . '</h5>';
                echo '        <p class="desc">' . $problem['description'] . '</p>';
                echo '        <button class="btn yellow">Send</button>'; 
                echo '    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">Company Info</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press Center</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Help</h3>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 CAV Grey Airlines. All rights reserved.</p>
        </div>
    </footer> 

   
    <script>
        
        function showConfirmation() {
            alert("Your issue has been sent!");
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        function toggleMenu() {
        const menu = document.getElementById('navBar');

            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'inline-flex';
            } else {
                menu.style.display = 'none';
            }
        }


        window.onclick = function(event) {
            if (!event.target.matches('.checkbtn') && !event.target.matches('.fa-bars')) {
                const menu = document.getElementById('navBAr');
                if (menu.style.display === 'block') {
                    menu.style.display = 'none';
                }
            }
        }


    </script>
</body>
</html>