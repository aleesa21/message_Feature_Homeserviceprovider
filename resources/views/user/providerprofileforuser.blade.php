<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $provider->name }} - Details</title>
    @include('header.providerprofileofuserheader')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: white;
            position: relative;
        }

        /* Background covering half the page */
        .half-background {
            position: absolute;
            width: 100%;
            height: 50%;
            top: 70px;
            left: 0;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            z-index: -1;
        }

        /* Profile Card Layout */
        .profile-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 700px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            background: white;
            overflow: hidden;
        }

        /* Profile Image on the Right */
        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            background: lightgray;
            border-radius: 10px;
            margin-left: 20px;
        }

        /* Profile Info on the Left */
        .profile-info {
            flex: 1;
            text-align: left;
        }

        h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        p {
            color: #777;
            font-size: 15px;
            margin: 5px 0;
        }

        .service-tag {
            background: #007bff;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 14px;
            display: inline-block;
            margin: 5px;
        }

        .reviews-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .reviews-btn:hover {
            background: #218838;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 350px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Star Rating */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            font-size: 25px;
            cursor: pointer;
            margin-top: 10px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
        }

        /* Comment Box */
        textarea {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Buttons */
        .feedback-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .feedback-btn:hover {
            background: #218838;
        }

        .btn-primary {
            background: rgb(40, 63, 167);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: rgb(78, 33, 136);
        }

        .close-btn {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .close-btn:hover {
            background: darkred;
        }

        /* --- New Styles for Request Service Modal --- */
        #requestServiceModal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1050; /* Higher than other elements */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background: rgba(0, 0, 0, 0.6); /* Dark semi-transparent background */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
        }

        .request-modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Adjust top margin as needed */
            padding: 30px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on your preference */
            max-width: 500px; /* Maximum width */
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            animation-name: animatetop;
            animation-duration: 0.4s;
            position: relative; /* For close button positioning */
        }

        /* Animation when modal appears */
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        /* Style for the modal header */
        .request-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .request-modal-header h3 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        /* Style for the close button */
        .request-modal-close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            margin-left: 10px;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .request-modal-close-btn:hover,
        .request-modal-close-btn:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            opacity: 1;
        }

        /* Style for the form elements */
        .request-modal-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .request-modal-content input[type=text],
        .request-modal-content input[type=datetime-local],
        .request-modal-content textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .request-modal-content textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Style for the submit button */
        .request-modal-content button[type=submit] {
            background-color: #007bff; /* Primary blue color */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100%; /* Make it a block-level button */
        }

        .request-modal-content button[type=submit]:hover {
            background-color: #0056b3; /* Darker shade of blue */
        }

        /* Optional: Add some spacing between elements */
        .request-modal-content > * {
            margin-bottom: 15px;
        }

        .request-modal-content > *:last-child {
            margin-bottom: 0; /* Remove margin from the last element */
        }
    </style>
</head>

<body>


    <div class="half-background"></div>

    <div class="profile-card">
        <div class="profile-info">
            <h2>{{ $provider->name }}</h2>
            <p><strong>Address:</strong> {{ $provider->address }}</p>
            <p><strong>Email:</strong> {{ $provider->email }}</p>
            <p><strong>Phone:</strong> {{ $provider->phone }}</p>

            <p><strong>Service Types:</strong></p>
            @foreach(json_decode($provider->service_type, true) as $service)
            <span class="service-tag">{{ $service }}</span>
            @endforeach


            <div class="feedback-container">
                <button class="feedback-btn" onclick="openModal()">Add Feedback</button>
                <form action="{{ route('feedback.show', $provider->id) }}" method="GET" style="display: inline;">
                    <button type="submit" class="reviews-btn">See Reviews</button>
                </form>
                <button class="btn btn-primary" onclick="openRequestForm()">Request Service</button>
            </div>
        </div>

        <img src="{{ Storage::url($provider->photo) }}" alt="{{ $provider->name }}" class="profile-img">
    </div>


    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">X</button>
            <h3>Give Feedback</h3>

            <form action="{{ route('feedback.store', $provider->id) }}" method="POST">
                @csrf

                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" required /><label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" required /><label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" required /><label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" required /><label for="star1">&#9733;</label>
                </div>

                <textarea name="message" rows="3" placeholder="Write your feedback..." required></textarea>

                <button type="submit" class="feedback-btn">Submit Feedback</button>
            </form>
        </div>
    </div>

    <div id="requestServiceModal" class="modal">
        <div class="request-modal-content">
            <div class="request-modal-header">
                <h3>Request Service</h3>
                <button type="button" class="request-modal-close-btn" onclick="closeRequestForm()">&times;</button>
            </div>
            <form action="{{ route('service.request.submit', $provider->id) }}" method="POST">
                @csrf

                <label for="service_details">Service Details:</label><br>
                <textarea id="service_details" name="service_details" rows="5" placeholder="Describe the service you need..." required></textarea><br>

                <label for="preferred_time">Preferred Time (Optional):</label><br>
                <input type="datetime-local" id="preferred_time" name="preferred_time"><br>

                <label for="contact_info">Your Contact Information:</label><br>
                <input type="text" id="contact_info" name="contact_info" placeholder="Your phone number or other contact details" required><br>

                <button type="submit" class="feedback-btn">Submit Request</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("feedbackModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("feedbackModal").style.display = "none";
        }

        function openRequestForm() {
            document.getElementById("requestServiceModal").style.display = "flex";
        }

        function closeRequestForm() {
            document.getElementById("requestServiceModal").style.display = "none";
        }
    </script>

</body>

</html>