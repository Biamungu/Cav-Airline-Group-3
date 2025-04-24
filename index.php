<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cav Grey Airlines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="logo_div">
            <div id="logoToggle" class="logo">
                <h1>Cav Grey Airlines</h1>
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
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.97889999999!2d28.322352!3d-15.387525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1940f5a7b5f5f5f5%3A0x5f5f5f5f5f5f5f5f!2sLusaka%2C%20Zambia!5e0!3m2!1sen!2szm!4v1633024000000!5m2!1sen!2szm"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="Support.php" class="dropbtn">Help</a>
            </div>

            <!-- This is the only login/logout section you need -->
            <div class="button_log">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <a href="admin-panel.php" class="admin-link">Admin Panel</a>
                    <?php endif; ?>

                    <a href="logout.php" class="logout-btn">Log Out
                        (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
                <?php else: ?>
                    <button class="button_l"><a href="login.php">Login</a></button>
                    <button class="button_l"><a href="create-account.php">Create Account</a></button>
                <?php endif; ?>
            </div>


            <div class="search-container">
                <button class="search-toggle"><i class="fas fa-search"></i></button>
                <div class="search-box">
                    <input type="text" placeholder="Search...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </nav>
    </header>






    <section class="hero-section">

        <h1 class="hero-text">Experience <span>Africa</span> <span class="text-black">to</span> <span>Europe</span></h1>

        <div class="booking-bar">
            <div class="booking-options">
                <div class="booking-option active">FLIGHT</div>
                <div class="booking-option">HOTEL</div>
                <div class="booking-option">CAR</div>
            </div>

            <form class="booking-form" method="POST" action="book_process.php">
                <div class="form-group">
                    <label>From</label>
                    <select name="from" required>
                        <option value="Lusaka, Zambia">Lusaka, Zambia</option>
                        <option value="Ndola, Zambia">Ndola, Zambia</option>
                        <option value="Livingstone, Zambia">Livingstone, Zambia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>To</label>
                    <select name="to" required>
                        <option value="Harare, Zimbabwe">Harare, Zimbabwe</option>
                        <option value="Johannesburg, South Africa">Johannesburg, South Africa</option>
                        <option value="Nairobi, Kenya">Nairobi, Kenya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Depart</label>
                    <input type="date" name="depart" required>
                </div>

                <div class="form-group">
                    <label>Return</label>
                    <input type="date" name="return">
                </div>

                <div class="form-group">
                    <label>Adult</label>
                    <select name="adult">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Child</label>
                    <select name="child">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Infant</label>
                    <select name="infant">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <button type="submit" class="search-btn">Submit</button>
            </form>

            <div class="booking-extras">
                <label>
                    <input type="checkbox"> Return
                </label>
                <label>
                    <input type="checkbox"> One-way
                </label>
                <label>
                    <input type="checkbox"> Multi-city
                </label>
                <span>Apply promo code ></span>
            </div>
        </div>
    </section>


    <section class="great-value-fares">
        <h2>Great Value Fares</h2>
        <div class="fares-grid">
            <div class="fare-card">
                <img src="images/image_6.jpg" alt="Lusaka">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Lusaka to Livingstone</div>
                    <div class="price">K1,130</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>

            <div class="fare-card">
                <img src="images/2.jpg" alt="Ndola">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Ndola to Lusaka</div>
                    <div class="price">K1,054</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>

            <div class="fare-card">
                <img src="images/3.jpg" alt="Harare">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Harare to Lusaka</div>
                    <div class="price">K1,115</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>

            <div class="fare-card">
                <img src="images/4.jpg" alt="Johannesburg">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Lusaka to Johannesburg</div>
                    <div class="price">K2,499</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>

            <div class="fare-card">
                <img src="images/5.jpeg" alt="Nairobi">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Lusaka to Nairobi</div>
                    <div class="price">K3,990</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>

            <div class="fare-card">
                <img src="images/image-25.avif" alt="Dubai">
                <div class="fare-content">
                    <div class="fly-from">Fly from</div>
                    <div class="destination">Lusaka to Dubai</div>
                    <div class="price">K17,100</div>
                    <button class="book-now-btn">BOOK NOW</button>
                </div>
            </div>
        </div>
    </section>

    <section id="home" class="content-overlay">
        <h2>Airport Experience, feel at home</h2>


        <video src="/video/airline-video.mp4"> </video>

        <div class="video-container">
            <video autoplay muted loop controls class="hero-video">
                <source src="video/airline-video.mp4.mp4" type="video/mp4">

            </video>
        </div>


        <section class="methods of payment">
            <h2>Payment Options</h2>
            <div class="payment-container">
                <div class="payment-card">
                    <i class="fab fa-cc-visa"></i>
                    <h3>Visa</h3>
                    <p>Secure payments with Visa credit and debit cards</p>
                </div>
                <div class="payment-card">
                    <i class="fab fa-cc-mastercard"></i>
                    <h3>Mastercard</h3>
                    <p>Pay securely using your Mastercard</p>
                </div>
                <div class="payment-card">
                    <i class="fab fa-paypal"></i>
                    <h3>PayPal</h3>
                    <p>Fast and secure payments with PayPal</p>
                </div>
                <div class="payment-card">
                    <i class="fab fa-apple-pay"></i>
                    <h3>Apple Pay</h3>
                    <p>Quick payments with Apple Pay</p>
                </div>
                <div class="payment-card">
                    <i class="fab fa-google-pay"></i>
                    <h3>Google Pay</h3>
                    <p>Easy payments with Google Pay</p>
                </div>
            </div>
            <div class="payment-info">

            </div>
            </div>
        </section>


        <section id="hotels" class="service-section">
            <h2>Our Premium Hotels</h2>

            <div class="dining-options">
                <div class="dining-card standard-room">
                    <div class="dining-content">
                        <h3>Standard Room Dining</h3>
                        <ul>
                            <li>Continental Breakfast</li>
                            <li>Lunch Menu Selection</li>
                            <li>Room Service until 10 PM</li>
                            <li>Access to Café Lounge</li>
                        </ul>
                    </div>
                </div>

                <div class="dining-card executive-suite">
                    <div class="dining-content">
                        <h3>Executive Suite Dining</h3>
                        <ul>
                            <li>24/7 Room Service</li>
                            <li>Access to Executive Lounge</li>
                            <li>Complimentary Evening Cocktails</li>
                            <li>Premium Restaurant Access</li>
                            <li>Premium Dstv for entertainment</li>
                        </ul>
                    </div>
                </div>

                <div class="dining-card presidential-suite">
                    <div class="dining-content">
                        <h3>Presidential Suite Dining</h3>
                        <ul>
                            <li>Personal Chef Service</li>
                            <li>Private Dining Room</li>
                            <li>Premium Wine Selection</li>
                            <li>VIP Restaurant Reservations</li>
                            <li>Starlink internet access + Premium Dstv</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section id="flights" class="service-section">
            <h2>Flight Classes</h2>
            <div class="flight-classes">
                <div class="flight-card economy-class">
                    <div class="flight-content">
                        <h3>Economy Class</h3>
                        <p>Comfortable travel with great value. Enjoy complimentary meals and entertainment.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>

                <div class="flight-card business-class">
                    <div class="flight-content">
                        <h3>Business Class</h3>
                        <p>Premium travel experience with priority service and exclusive lounge access.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>

                <div class="flight-card first-class">
                    <div class="flight-content">
                        <h3>First Class</h3>
                        <p>Ultimate luxury travel with private suites and personalized service.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>
            </div>
        </section>


        <section id="cars" class="service-section">
            <h2>Car Services</h2>
            <div class="car-services">
                <div class="car-card economy-vehicle">
                    <div class="car-content">
                        <h3>Economy Vehicle</h3>
                        <p>Affordable and reliable transportation for your daily needs.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>

                <div class="car-card executive-vehicle">
                    <div class="car-content">
                        <h3>Executive Vehicle</h3>
                        <p>Premium comfort with professional service for business travel.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>

                <div class="car-card luxury-vehicle">
                    <div class="car-content">
                        <h3>Luxury Vehicle</h3>
                        <p>Experience ultimate luxury with our high-end vehicles and chauffeur service.</p>
                        <a href="#" class="learn-more">Learn more</a>
                    </div>
                </div>
            </div>
        </section>


        <section class="app-download">
            <div class="app-content">
                <h2>Download our mobile app for easy access</h2>
                <div class="app-buttons">
                    <a href="#" class="app-store">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                            alt="Download on App Store">
                    </a>
                    <a href="#" class="play-store">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Get it on Google Play">
                    </a>
                </div>
            </div>
            <div class="app-preview">
                <div class="phone-mockup">
                    <div class="phone-screen">
                        <img src="https://placehold.co/300x600/2c3e50/FFF/png?text=Cav+Grey+App"
                            alt="Mobile App Preview">
                    </div>
                </div>
            </div>
        </section>


        <div class="social-media">
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </section>


    <section class="footer-info">
        <div class="info-columns">
            <div class="info-column">
                <h4>Book a Trip</h4>
                <ul>
                    <li><a href="#flight">Flight</a></li>
                    <li><a href="#hotel">Hotel</a></li>
                    <li><a href="#car">Car</a></li>

                </ul>
            </div>

            <div class="info-column">
                <h4>Manage Booking</h4>
                <ul>
                    <li><a href="#retrieve">Retrieve Booking</a></li>
                    <li><a href="#check-in">Check-in</a></li>
                    <li><a href="#print">Print Boarding Pass</a></li>
                    <li><a href="#change">Change Flight</a></li>
                    <li><a href="#upgrade">Upgrade Request</a></li>
                    <li><a href="#seats">Reserve Seats</a></li>
                </ul>
            </div>

            <div class="info-column">
                <h4>Support</h4>
                <ul>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#service">Customer Service</a></li>
                    <li><a href="#faq">Help and FAQ</a></li>
                    <li><a href="#feedback">Traveler Reviews</a></li>
                </ul>
            </div>

            <div class="info-column">
                <h4>About Cav Grey</h4>
                <ul>
                    <li><a href="#story">Our Story</a></li>
                    <li><a href="#payment">Payments</a></li>
                    <li><a href="#careers">Careers</a></li>
                    <li><a href="#investor">Investor Relations</a></li>
                    <li><a href="#press">Press Reviews</a></li>
                </ul>
            </div>

            <div class="info-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#promos">Promos</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#schedule">Flight Schedule</a></li>
                    <li><a href="#payment">Payment Options</a></li>
                    <li><a href="#airports">List of Airports</a></li>
                    <li><a href="#agents">Partner Agents</a></li>
                    <li><a href="#reviews">Cav Air Reviews</a></li>
                </ul>
            </div>

            <div class="info-column">
                <h4>Follow Us</h4>
                <ul class="social-links">
                    <li><a href="#facebook"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#instagram"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#twitter"><i class="fab fa-twitter"></i> Twitter</a></li>
                </ul>
            </div>
        </div>
    </section>


    <div id="chatbot-container" class="chatbot-container">
        <div class="chatbot-header">
            <h3>Chat Support</h3>
            <button class="close-chat">&times;</button>
        </div>
        <div class="chatbot-messages">
            <div class="message bot-message">
                Hello! How can I help you today?
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" placeholder="Type your message...">
            <button><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <div id="flightBookingModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 id="modalRoute">Flight Details</h2>
            <div class="flight-options">
                <div class="flight-class">
                    <h3>Economy Class</h3>
                    <div class="flight-times">
                        <div class="flight-time-slot">
                            <span class="time">06:00</span>
                            <span class="price">K1,130</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">12:30</span>
                            <span class="price">K1,230</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">18:45</span>
                            <span class="price">K1,180</span>
                            <button class="select-flight">Select</button>
                        </div>
                    </div>
                </div>

                <div class="flight-class">
                    <h3>Business Class</h3>
                    <div class="flight-times">
                        <div class="flight-time-slot">
                            <span class="time">07:15</span>
                            <span class="price">K2,450</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">13:45</span>
                            <span class="price">K2,650</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">19:30</span>
                            <span class="price">K2,550</span>
                            <button class="select-flight">Select</button>
                        </div>
                    </div>
                </div>

                <div class="flight-class">
                    <h3>First Class</h3>
                    <div class="flight-times">
                        <div class="flight-time-slot">
                            <span class="time">08:30</span>
                            <span class="price">K3,890</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">14:15</span>
                            <span class="price">K4,090</span>
                            <button class="select-flight">Select</button>
                        </div>
                        <div class="flight-time-slot">
                            <span class="time">20:00</span>
                            <span class="price">K3,990</span>
                            <button class="select-flight">Select</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Cav Airlines, @Harare along magamba way 5ive Ave. All rights reserved.</p>
        <p>Contact: <a href="mailto:mandeyatendai@gmail.com">mandeyatendai@gmail.com</a> | Phone: +260972109894</p>

        <div class="chatbot-icon">
            <i class="fas fa-comments"></i>
        </div>
    </footer>


    <script>

        const bookingOptions = document.querySelectorAll('.booking-option');

        bookingOptions.forEach(option => {
            option.addEventListener('click', () => {

                bookingOptions.forEach(opt => opt.classList.remove('active'));

                option.classList.add('active');
            });
        });


        function openLogin() {
            document.getElementById('loginModal').style.display = 'flex';
        }

        function closeLogin() {
            document.getElementById('loginModal').style.display = 'none';
        }


        window.onclick = function (event) {
            const modal = document.getElementById('loginModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>


    <script>

        const chatbotIcon = document.querySelector('.chatbot-icon');
        const chatbotContainer = document.getElementById('chatbot-container');
        const closeChatBtn = document.querySelector('.close-chat');
        const chatInput = document.querySelector('.chatbot-input input');
        const chatMessages = document.querySelector('.chatbot-messages');
        const sendButton = document.querySelector('.chatbot-input button');

        chatbotIcon.addEventListener('click', () => {
            chatbotContainer.classList.toggle('active');
        });

        closeChatBtn.addEventListener('click', () => {
            chatbotContainer.classList.remove('active');
        });

        function sendMessage() {
            const message = chatInput.value.trim();
            if (message) {

                const userMessage = document.createElement('div');
                userMessage.className = 'message user-message';
                userMessage.textContent = message;
                chatMessages.appendChild(userMessage);


                chatInput.value = '';


                setTimeout(() => {
                    const botMessage = document.createElement('div');
                    botMessage.className = 'message bot-message';
                    botMessage.textContent = "Thank you for your message. Our team will assist you shortly.";
                    chatMessages.appendChild(botMessage);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1000);
            }
        }

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });


        const searchToggle = document.querySelector('.search-toggle');
        const searchBox = document.querySelector('.search-box');

        searchToggle.addEventListener('click', () => {
            searchBox.classList.toggle('active');
            if (searchBox.classList.contains('active')) {
                searchBox.querySelector('input').focus();
            }
        });
    </script>

    <script>

        const flightBookingModal = document.getElementById('flightBookingModal');
        const bookNowButtons = document.querySelectorAll('.book-now-btn');
        const closeModalBtn = document.querySelector('.close-modal');
        const modalRoute = document.getElementById('modalRoute');
        const selectFlightButtons = document.querySelectorAll('.select-flight');


        bookNowButtons.forEach(button => {
            button.addEventListener('click', () => {
                const destination = button.closest('.fare-content').querySelector('.destination').textContent;
                modalRoute.textContent = destination;
                flightBookingModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });


        closeModalBtn.addEventListener('click', () => {
            flightBookingModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });


        window.addEventListener('click', (event) => {
            if (event.target === flightBookingModal) {
                flightBookingModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        selectFlightButtons.forEach(button => {
            button.addEventListener('click', () => {
                const timeSlot = button.closest('.flight-time-slot');
                const time = timeSlot.querySelector('.time').textContent;
                const price = timeSlot.querySelector('.price').textContent;
                const flightClass = button.closest('.flight-class').querySelector('h3').textContent;
                const route = modalRoute.textContent;

                alert(`Flight selected!\n\nRoute: ${route}\nClass: ${flightClass}\nTime: ${time}\nPrice: ${price}\n\nProceeding to payment...`);
                flightBookingModal.style.display = 'none';
                document.body.style.overflow = 'auto';
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


        window.onclick = function (event) {
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