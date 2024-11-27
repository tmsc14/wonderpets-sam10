<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Sentiment Analysis</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif;
            background-color: #f9f9f9; /* Light background for elegance */
            color: #333; /* Dark text for readability */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            text-align: center;
        }
        .container {
            max-width: 1200px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            background-color: white; /* White background for the container */
        }
        .hero {
            margin-bottom: 40px; /* Space below hero section */
        }
        .hero h1 {
            font-size: 3rem; /* Larger font size for the title */
            margin-bottom: 20px;
            color: #1f2937; /* Darker color for the title */
            animation: fadeIn 1s ease-in-out; /* Fade-in effect */
        }
        .hero p {
            font-size: 1.5rem; /* Slightly larger paragraph text */
            margin-bottom: 30px;
            line-height: 1.6; /* Improved line spacing */
        }
        .btn {
            display: inline-block;
            padding: 12px 30px; /* Button size */
            margin: 10px;
            background-color: #FF2D20; /* Bright red background */
            color: white;
            border-radius: 25px; /* Rounded button edges */
            text-decoration: none;
            font-weight: bold; /* Bold text for emphasis */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
        }
        .btn:hover {
            background-color: #d13819; /* Darker red for hover effect */
            transform: translateY(-3px); /* Lift effect on hover */
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .features {
            display: flex;
            justify-content: space-between; /* Space between feature items */
            margin-top: 40px; /* Space above features section */
        }
        .feature {
            width: calc(33% - 20px); /* Responsive feature item width with spacing */
            text-align: left;
        }
        .feature h3 {
            font-size: 1.5rem; /* Feature title size */
            margin-bottom: 10px;
            color: #FF2D20; /* Accent color for feature titles */
        }
        .feature p {
            font-size: 1rem; /* Feature description size */
        }

        @media (max-width: 768px) {
           .features {
               flex-direction: column; /* Stack features on smaller screens */
               align-items: center;
           }
           .feature {
               width: auto; /* Allow full width on small screens */
               margin-bottom: 20px; /* Space between stacked features */
           }
           .hero h1 {
               font-size: 2rem; /* Responsive font size for heading */
           }
           .hero p {
               font-size: 1.2rem; /* Responsive paragraph size */
           }
       }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Welcome to the Sentiment Analysis App</h1>
            <p>Unlock powerful insights from your text with our state-of-the-art sentiment analysis tool.</p>
            <div>
                <a href="/login" class="btn">Login</a>
                <a href="/register" class="btn">Register</a>
            </div>
        </div>

        <div class="features">
            <div class="feature">
                <h3>Precision Insights</h3>
                <p>Utilize advanced algorithms to deliver accurate sentiment evaluations.</p>
            </div>
            
            <div class="feature">
                <h3>Sleek User Experience</h3>
                <p>Navigate effortlessly with our intuitive and elegant interface.</p>
            </div>

            <div class="feature">
                <h3>Instant Feedback</h3>
                <p>Receive real-time analysis results to make informed decisions quickly.</p>
            </div>
        </div>
    </div>
</body>
</html>