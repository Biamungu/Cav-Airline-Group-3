<?php

include 'db.php';

session_start();

$flightNotification = "";
$hotelNotification = "";
$carNotification = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookingType']) && $_POST['bookingType'] == 'flights') {
    $tripType = htmlspecialchars($_POST['trip-type']);
    $from = htmlspecialchars($_POST['from']);
    $to = htmlspecialchars($_POST['to']);
    $departDate = htmlspecialchars($_POST['departDate']);
    $returnDate = htmlspecialchars($_POST['returnDate']);
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $infants = intval($_POST['infants']);
    $cabinClass = htmlspecialchars($_POST['cabinClass']);
   
    $flightNotification = "Flight booking successful! From: $from To: $to Depart Date: $departDate.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookingType']) && $_POST['bookingType'] == 'hotels') {
    $hotelDestination = htmlspecialchars($_POST['destination']);
    $checkIn = htmlspecialchars($_POST['checkIn']);
    $checkOut = htmlspecialchars($_POST['checkOut']);
    $hotelAdults = intval($_POST['hotelAdults']);
    $hotelChildren = intval($_POST['hotelChildren']);
    $rooms = intval($_POST['rooms']);
    $starRating = htmlspecialchars($_POST['starRating']);
    

    $hotelNotification = "Hotel booking successful! Destination: $hotelDestination Check-in: $checkIn Check-out: $checkOut.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookingType']) && $_POST['bookingType'] == 'cars') {
    $pickupLocation = htmlspecialchars($_POST['pickupLocation']);
    $pickupDate = htmlspecialchars($_POST['pickupDate']);
    $pickupTime = htmlspecialchars($_POST['pickupTime']);
    $dropoffDate = htmlspecialchars($_POST['dropoffDate']);
    $dropoffTime = htmlspecialchars($_POST['dropoffTime']);
    $carType = htmlspecialchars($_POST['carType']);
    
  
    $carNotification = "Car booking successful! Pick-up Location: $pickupLocation Pick-up Date: $pickupDate.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link rel="stylesheet" href="styles5.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <div class="dropdown">
                <a href="Support.php" class="dropbtn">Contact Us</a>
                
            </div>
            <div class ="button_log">
                <button class="button_l">
                     <a href="Login.php">Login</a>
                </button>
            </div>

        </nav>
    </header>

    <section class="booking-section">
        <div class="booking-container">
            <div class="booking-tabs">
                <button class="tab-btn active" data-tab="flights">
                    <i class="fas fa-plane"></i>
                    Flights
                </button>
                <button class="tab-btn" data-tab="hotels">
                    <i class="fas fa-hotel"></i>
                    Hotels
                </button>
                <button class="tab-btn" data-tab="cars">
                    <i class="fas fa-car"></i>
                    Cars
                </button>
            </div>

            <?php if ($flightNotification): ?>
                <div class="notification success">
                    <p><?php echo $flightNotification; ?></p>
                </div>
            <?php endif; ?>

            <form class="booking-form flights-form active" method="POST">
                <input type="hidden" name="bookingType" value="flights">
                <div class="trip-type-selector">
                    <label class="radio-container">
                        <input type="radio" name="trip-type" value="round-trip" checked>
                        <span class="radio-label">Round Trip</span>
                    </label>
                    <label class="radio-container">
                        <input type="radio" name="trip-type" value="one-way">
                        <span class="radio-label">One Way</span>
                    </label>
                    <label class="radio-container">
                        <input type="radio" name="trip-type" value="multi-city">
                        <span class="radio-label">Multi-City</span>
                    </label>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-plane-departure"></i>
                            From
                        </label>
                        <div class="input-with-icon">
                            <input type="text" name="from" placeholder="City or Airport" class="location-input" required>
                            <i class="fas fa-search location-search"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-plane-arrival"></i>
                            To
                        </label>
                        <div class="input-with-icon">
                            <input type="text" name="to" placeholder="City or Airport" class="location-input" required>
                            <i class="fas fa-search location-search"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Depart
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="departDate" class="date-input" required>
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group return-date">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Return
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="returnDate" class="date-input">
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-users"></i>
                            Passengers
                        </label>
                        <div class="passenger-selector">
                            <div class="passenger-type">
                                <div class="passenger-info">
                                    <span class="passenger-label">Adults</span>
                                    <span class="passenger-age">12+ years</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">1</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="adults" value="1">
                            </div>
                            <div class="passenger-type">
                                <div class="passenger-info">
                                    <span class="passenger-label">Children</span>
                                    <span class="passenger-age">2-11 years</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">0</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="children" value="0">
                            </div>
                            <div class="passenger-type">
                                <div class="passenger-info">
                                    <span class="passenger-label">Infants</span>
                                    <span class="passenger-age">Under 2</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">0</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="infants" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-chair"></i>
                            Cabin Class
                        </label>
                        <div class="cabin-class-selector">
                            <select name="cabinClass" class="cabin-select" required>
                                <option value="economy">Economy</option>
                                <option value="premium-economy">Premium Economy</option>
                                <option value="business">Business</option>
                                <option value="first">First Class</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <?php if ($hotelNotification): ?>
                <div class="notification success">
                    <p><?php echo $hotelNotification; ?></p>
                </div>
            <?php endif; ?>

            <form class="booking-form hotels-form" method="POST">
                <input type="hidden" name="bookingType" value="hotels">
                <div class="form-grid">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-map-marker-alt"></i>
                            Destination
                        </label>
                        <div class="input-with-icon">
                            <input type="text" name="destination" placeholder="City, Hotel, or Area" class="location-input" required>
                            <i class="fas fa-search location-search"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Check-in
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="checkIn" class="date-input" required>
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Check-out
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="checkOut" class="date-input" required>
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-users"></i>
                            Guests
                        </label>
                        <div class="guest-selector">
                            <div class="guest-type">
                                <div class="guest-info">
                                    <span class="guest-label">Adults</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">2</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="hotelAdults" value="2">
                            </div>
                            <div class="guest-type">
                                <div class="guest-info">
                                    <span class="guest-label">Children</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">0</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="hotelChildren" value="0">
                            </div>
                            <div class="guest-type">
                                <div class="guest-info">
                                    <span class="guest-label">Rooms</span>
                                </div>
                                <div class="counter">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="count">1</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                                <input type="hidden" name="rooms" value="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-star"></i>
                            Star Rating
                        </label>
                        <div class="star-rating">
                            <select name="starRating" class="star-select" required>
                                <option value="3">3+ Stars</option>
                                <option value="4">4+ Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Search Hotels
                    </button>
                </div>
            </form>

            <?php if ($carNotification): ?>
                <div class="notification success">
                    <p><?php echo $carNotification; ?></p>
                </div>
            <?php endif; ?>

            <form class="booking-form cars-form" method="POST">
                <input type="hidden" name="bookingType" value="cars">
                <div class="form-grid">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-map-marker-alt"></i>
                            Pick-up Location
                        </label>
                        <div class="input-with-icon">
                            <input type="text" name="pickupLocation" placeholder="City, Airport, or Address" class="location-input" required>
                            <i class="fas fa-search location-search"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Pick-up Date
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="pickupDate" class="date-input" required>
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-clock"></i>
                            Pick-up Time
                        </label>
                        <div class="time-input-container">
                            <input type="time" name="pickupTime" class="time-input" required>
                            <i class="fas fa-clock time-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar"></i>
                            Drop-off Date
                        </label>
                        <div class="date-input-container">
                            <input type="date" name="dropoffDate" class="date-input" required>
                            <i class="fas fa-calendar-alt date-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-clock"></i>
                            Drop-off Time
                        </label>
                        <div class="time-input-container">
                            <input type="time" name="dropoffTime" class="time-input" required>
                            <i class="fas fa-clock time-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-car"></i>
                            Car Type
                        </label>
                        <div class="car-type-selector">
                            <select name="carType" class="car-select" required>
                                <option value="economy">Economy</option>
                                <option value="compact">Compact</option>
                                <option value="midsize">Midsize</option>
                                <option value="suv">SUV</option>
                                <option value="luxury">Luxury</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Search Cars
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="featured-flights">
            <h2>Featured Flight Destinations</h2>
            <div class="flight-cards">
                <div class="flight-card">
                    <div class="flight-image">
                        <img src="/images/paris.jpeg" alt="Paris">
                        <div class="flight-price">From $599</div>
                    </div>
                    <div class="flight-info">
                        <h3>Paris, France</h3>
                        <p class="flight-route">New York (JFK) → Paris (CDG)</p>
                        <p class="flight-description">Experience the city of love with our special winter deals. Direct flights available daily.</p>
                        <div class="flight-details">
                            <span><i class="fas fa-clock"></i> 7h 25m</span>
                            <span><i class="fas fa-plane"></i> Direct</span>
                        </div>
                        <button class="book-now-btn">Book Now</button>
                    </div>
                </div>

                <div class="flight-card">
                    <div class="flight-image">
                        <img src="/images/tokyo.jpeg" alt="Tokyo">
                        <div class="flight-price">From $899</div>
                    </div>
                    <div class="flight-info">
                        <h3>Tokyo, Japan</h3>
                        <p class="flight-route">Los Angeles (LAX) → Tokyo (NRT)</p>
                        <p class="flight-description">Discover the perfect blend of tradition and modernity in Japan's capital.</p>
                        <div class="flight-details">
                            <span><i class="fas fa-clock"></i> 11h 40m</span>
                            <span><i class="fas fa-plane"></i> Direct</span>
                        </div>
                        <button class="book-now-btn">Book Now</button>
                    </div>
                </div>

                <div class="flight-card">
                    <div class="flight-image">
                        <img src="/images/dubai.jpeg" alt="Dubai">
                        <div class="flight-price">From $749</div>
                    </div>
                    <div class="flight-info">
                        <h3>Dubai, UAE</h3>
                        <p class="flight-route">London (LHR) → Dubai (DXB)</p>
                        <p class="flight-description">Experience luxury and adventure in the jewel of the Middle East.</p>
                        <div class="flight-details">
                            <span><i class="fas fa-clock"></i> 6h 55m</span>
                            <span><i class="fas fa-plane"></i> Direct</span>
                        </div>
                        <button class="book-now-btn">Book Now</button>
                    </div>
                </div>

                <div class="flight-card">
                    <div class="flight-image">
                        <img src="/images/sydney.jpeg" alt="Sydney">
                        <div class="flight-price">From $1099</div>
                    </div>
                    <div class="flight-info">
                        <h3>Sydney, Australia</h3>
                        <p class="flight-route">Singapore (SIN) → Sydney (SYD)</p>
                        <p class="flight-description">Explore the vibrant culture and stunning beaches of Australia's largest city.</p>
                        <div class="flight-details">
                            <span><i class="fas fa-clock"></i> 8h 15m</span>
                            <span><i class="fas fa-plane"></i> Direct</span>
                        </div>
                        <button class="book-now-btn">Book Now</button>
                    </div>
                </div>
            </div>
    </section>


    <section class="hotels-section" id="hotels">
            <h2>Luxury Hotels & Resorts</h2>
            <div class="hotel-cards">
                <div class="hotel-card">
                    <div class="hotel-image">
                        <img src="/images/lstone.jpeg" alt="Royal Livingstone Hotel">
                        <div class="hotel-price">From $450/night</div>
                    </div>
                    <div class="hotel-info">
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Royal Livingstone Hotel</h3>
                        <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Victoria Falls, Zambia</p>
                        <p class="hotel-description">Experience luxury on the banks of the Zambezi River with stunning views of Victoria Falls. Features spa, fine dining, and exclusive falls access.</p>
                        <div class="hotel-amenities">
                            <span><i class="fas fa-wifi"></i> Free WiFi</span>
                            <span><i class="fas fa-swimming-pool"></i> Pool</span>
                            <span><i class="fas fa-spa"></i> Spa</span>
                        </div>
                        <button class="book-now-btn">Book Hotel</button>
                    </div>
                </div>

                <div class="hotel-card">
                    <div class="hotel-image">
                        <img src="/images/four seasons serengeti.jpeg" alt="Four Seasons Serengeti">
                        <div class="hotel-price">From $895/night</div>
                    </div>
                    <div class="hotel-info">
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Four Seasons Serengeti</h3>
                        <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Serengeti National Park, Tanzania</p>
                        <p class="hotel-description">Luxury safari lodge with infinity pool overlooking the Serengeti plains. Watch wildlife from your private balcony.</p>
                        <div class="hotel-amenities">
                            <span><i class="fas fa-wifi"></i> Free WiFi</span>
                            <span><i class="fas fa-utensils"></i> Restaurant</span>
                            <span><i class="fas fa-binoculars"></i> Safari</span>
                        </div>
                        <button class="book-now-btn">Book Hotel</button>
                    </div>
                </div>

                <div class="hotel-card">
                    <div class="hotel-image">
                        <img src="/images/la mamounia.jpeg" alt="La Mamounia">
                        <div class="hotel-price">From $750/night</div>
                    </div>
                    <div class="hotel-info">
                        <div class="hotel-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>La Mamounia</h3>
                        <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Marrakech, Morocco</p>
                        <p class="hotel-description">Iconic palace hotel featuring traditional Moroccan architecture, luxury spa, and world-class dining experiences.</p>
                        <div class="hotel-amenities">
                            <span><i class="fas fa-wifi"></i> Free WiFi</span>
                            <span><i class="fas fa-spa"></i> Spa</span>
                            <span><i class="fas fa-swimming-pool"></i> Pool</span>
                        </div>
                        <button class="book-now-btn">Book Hotel</button>
                    </div>
                </div>
            </div>
    </section>


    <section class="car-rental-section" id="cars">
            <h2>Premium Car Rentals</h2>
            <div class="car-cards">
                <div class="car-card">
                    <div class="car-image">
                        <img src="/images/rover.jpeg" alt="Range Rover Sport">
                        <div class="car-price">From $150/day</div>
                    </div>
                    <div class="car-info">
                        <h3>Range Rover Sport</h3>
                        <p class="car-category"><i class="fas fa-car"></i> Luxury SUV</p>
                        <div class="car-features">
                            <span><i class="fas fa-user"></i> 5 Seats</span>
                            <span><i class="fas fa-cog"></i> Automatic</span>
                            <span><i class="fas fa-gas-pump"></i> Diesel</span>
                        </div>
                        <p class="car-description">Perfect for both city drives and safari adventures. Features premium leather interior and advanced off-road capabilities.</p>
                        <button class="book-now-btn">Reserve Car</button>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-image">
                        <img src="/images/s class benz.jpeg" alt="Mercedes-Benz S-Class">
                        <div class="car-price">From $200/day</div>
                    </div>
                    <div class="car-info">
                        <h3>Mercedes-Benz S-Class</h3>
                        <p class="car-category"><i class="fas fa-car"></i> Luxury Sedan</p>
                        <div class="car-features">
                            <span><i class="fas fa-user"></i> 5 Seats</span>
                            <span><i class="fas fa-cog"></i> Automatic</span>
                            <span><i class="fas fa-snowflake"></i> A/C</span>
                        </div>
                        <p class="car-description">Ultimate luxury and comfort for executive travel. Includes chauffeur service upon request.</p>
                        <button class="book-now-btn">Reserve Car</button>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-image">
                        <img src="/images/download.jpeg" alt="Toyota Land Cruiser">
                        <div class="car-price">From $120/day</div>
                    </div>
                    <div class="car-info">
                        <h3>Toyota Land Cruiser</h3>
                        <p class="car-category"><i class="fas fa-car"></i> Safari SUV</p>
                        <div class="car-features">
                            <span><i class="fas fa-user"></i> 7 Seats</span>
                            <span><i class="fas fa-cog"></i> Automatic</span>
                            <span><i class="fas fa-mountain"></i> 4x4</span>
                        </div>
                        <p class="car-description">Reliable and powerful SUV perfect for safari adventures and rough terrain exploration.</p>
                        <button class="book-now-btn">Reserve Car</button>
                    </div>
                </div>
            </div>
     </section>
</main>

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

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });


    const tabButtons = document.querySelectorAll('.tab-btn');
    const bookingForms = document.querySelectorAll('.booking-form');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
        
            tabButtons.forEach(btn => btn.classList.remove('active'));
            bookingForms.forEach(form => {
                form.classList.remove('active');
                if (form.classList.contains('hotels-form') || form.classList.contains('cars-form')) {
                    form.style.transform = 'translateX(100%)';
                    form.style.opacity = '0';
                }
            });

        
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            const activeForm = document.querySelector(`.${tabId}-form`);
            
            if (activeForm) {
                activeForm.classList.add('active');
                if (activeForm.classList.contains('hotels-form') || activeForm.classList.contains('cars-form')) {
                    setTimeout(() => {
                        activeForm.style.transform = 'translateX(0)';
                        activeForm.style.opacity = '1';
                    }, 50);
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        const counterBtns = document.querySelectorAll('.counter-btn');
        counterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const counter = this.parentElement;
                const countDisplay = counter.querySelector('.count');
                let count = parseInt(countDisplay.textContent);
                
                if (this.classList.contains('plus')) {
                    count++;
                } else if (this.classList.contains('minus') && count > 0) {
                    count--;
                }
                
                countDisplay.textContent = count;
            });
        });
        

        const roomOptions = document.querySelectorAll('.room-option');
        roomOptions.forEach(option => {
            option.addEventListener('click', function() {
                roomOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
        
        const carOptions = document.querySelectorAll('.car-option');
        carOptions.forEach(option => {
            option.addEventListener('click', function() {
                carOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
        

        const paymentMethods = document.querySelectorAll('.payment-method');
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                paymentMethods.forEach(m => m.classList.remove('active'));
                this.classList.add('active');
                
            
                const paymentType = this.querySelector('span').textContent;
                showPaymentForm(paymentType);
            });
        });
        
    });

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