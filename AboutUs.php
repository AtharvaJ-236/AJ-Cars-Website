
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('WhatsApp Image 2024-08-05 at 07.37.29.jpeg');
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the image */
            background-attachment: fixed; /* Keep the background fixed */
            background-repeat: no-repeat; /* Prevent repeating the image */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: White; /* Change h1 color to white */
            text-align: center;
            margin-top: 50px;
        }
        .side-nav {
            height: 100%; /* Full-height */
            width: 0; /* Start closed */
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8); /* Background color with opacity */
            color: white; /* Text color */
            overflow-x: hidden; /* Disable horizontal scroll */
            transition: 0.5s; /* Smooth transition for opening and closing */
            padding-top: 60px; /* Space from top */
        }
        .side-nav a {
            padding: 8px 16px; /* Padding for links */
            text-decoration: none; /* Remove underline */
            font-size: 25px; /* Font size */
            color: white; /* Link color */
            display: block; /* Display links as block */
            transition: 0.3s; /* Transition effect */
        }
        .side-nav a:hover {
            background-color: #575757; /* Change background color on hover */
        }
        .side-nav .closebtn {
            position: absolute; /* Position the close button */
            top: 20px;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            border: none;
            padding: 10px 15px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .content {
            padding: 20px;
            color: white;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background for readability */
            margin: 50px auto;
            width: 80%;
            border-radius: 8px;
        }
        .content h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 18px;
            line-height: 1.6;
        }
    </style>
    <title>About Us</title>
</head>
<body>
    <div id="myNav" class="side-nav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="Main Page Project.html">Home</a>
        <a href="AboutUs.html">About Us</a>
        <a href="Profile.html">Log Out</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰</button>

    <div class="content">
        <img src='rolls_royce_phantom_top_10.jpg.webp' alt="Car" width="320px" height="210px" align=centre>
        <h1>About Us</h1>
        <h2>Welcome to AJ Cars!</h2>
        <p>We're passionate about automobiles and dedicated to providing exceptional service.</p>
        <p><strong>Our Mission:</strong> To give our customers the appropriate and the best car which is suitable for their lifestyle, fulfill their dream of Buying a new Car and giving their life a new speed of happiness and joy!!!</p>
        <p><strong>What We Offer:</strong></p>
        <ul style="text-align: left; display: inline-block;">
            <li><strong>Varied Vehicle Selection:</strong> Find your ideal car from our extensive inventory.</li>
            <li><strong>Expert Services:</strong> Enjoy reliable repairs and maintenance from skilled technicians.</li>
        </ul>
        <p>At AJ Cars, we value integrity, excellence, and innovation. Explore our site or visit us to see how we can help with your automotive needs. Thank you for choosing AJ Cars!</p>
    </div>

    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0";
        }
    </script>
</body>
</html>
