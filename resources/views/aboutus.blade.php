<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Home Service Provider Platform</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px 0;
        }
        header {
            background: #3c4858;
            color: #ffffff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #007bff 3px solid;
            text-align: center;
        }
        header h1 {
            margin: 0;
            padding: 0 0 15px 0;
            font-size: 2.5em;
        }
        .name {
            font-size: 2.5em; /* Adjusted for h1 */
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            color: #00aaff; /* A lighter blue for contrast */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
            background: linear-gradient(to right, #00509e, #00aaff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            margin: 10px 0;
            display: inline-block; /* To apply gradient to text */
        }
        .main-content {
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        .main-content h2 {
            color: #00509e;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        .main-content p {
            margin-bottom: 15px;
        }
        .highlights {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            text-align: center;
        }
        .highlight-item {
            flex: 1;
            min-width: 280px;
            background: #e6f7ff; /* Light blue background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .highlight-item h3 {
            color: #007bff;
            margin-top: 0;
        }
        .cta {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background: #3c4858;
            color: white;
            border-radius: 8px;
        }
        .cta a {
            display: inline-block;
            background: #00aaff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .cta a:hover {
            background-color: #007bff;
        }
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            color: #777;
            font-size: 0.9em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
            .highlights {
                flex-direction: column;
                align-items: center;
            }
            .highlight-item {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><span class="name">About Us</span></h1>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <h2>Our Story: Connecting You with Local Service Excellence</h2>
            <p>At Home Service Provider, we understand the frustration of finding a reliable local service provider. Whether you need a plumber, an electrician, a carpenter, or any other home service, the search can be time-consuming and often leads to uncertainty about trustworthiness and availability.</p>
            <p>We started Home Service Provider in 2024 with a clear goal: to simplify this process. We believe that everyone deserves easy access to trusted, local, and available service professionals. Our platform was born out of the personal challenges many faced in finding dependable help right in their neighborhood, particularly in Biratnagar.</p>

            <h2>What We Do: Your Go-To Platform for Home Services</h2>
            <p>Home Service Providre is more than just a directory; it's a dedicated platform designed to directly connect you, the customer, with trusted local service providers. We eliminate the guesswork and the need for extensive searching by offering a streamlined solution:</p>
            <ul>
                <li>A comprehensive directory of services across various categories.</li>
                <li>Detailed profiles of providers, showcasing their expertise and qualifications.</li>
                <li>Direct contact options, allowing you to reach out effortlessly.</li>
                <li>Authentic customer reviews, empowering you to make informed decisions based on real experiences.</li>
            </ul>
            <p>By bringing all these elements together, we aim to save you time and effort, letting you focus on what truly matters in your life while we handle the connections.</p>

            <h2>Our Vision & Values</h2>
            <div class="highlights">
                <div class="highlight-item">
                    <h3>Simplify Your Search</h3>
                    <p>We believe finding home services should be easy. Our intuitive platform helps you quickly locate and connect with the right professional.</p>
                </div>
                <div class="highlight-item">
                    <h3>Build Local Trust</h3>
                    <p>We empower communities by fostering direct connections between users and verified local experts, built on transparency and genuine reviews.</p>
                </div>
                <div class="highlight-item">
                    <h3>Ensure Transparency</h3>
                    <p>With detailed provider profiles and customer feedback, you get a clear picture of who you're hiring, without any middlemen or hidden agendas.</p>
                </div>
                <div class="highlight-item">
                    <h3>Promote Convenience</h3>
                    <p>Access essential services anytime, anywhere. Compare options, read reviews, and connect—all from the convenience of your device.</p>
                </div>
            </div>

            <div class="cta">
                <p>Ready to find a trusted service provider in your area?</p>
                <a href="/">Start Your Search Today!</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Home Service provider. All rights reserved. | Connect with us:homeserviceprocider@gmail.com</p>
            <p>Serving Biratnagar.</p>
        </div>
    </footer>
</body>
</html>