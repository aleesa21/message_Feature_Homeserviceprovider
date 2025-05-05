<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $provider->name }} - Details</title>
    @include('header.otherprovider')
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
    </style>
</head>

<body>


    <div class="half-background"></div>

    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Profile Info (Left Side) -->
        <div class="profile-info">
            
            <h2>{{ $provider->name }}</h2>
            <p><strong>Address:</strong> {{ $provider->address }}</p>
            <p><strong>Email:</strong> {{ $provider->email }}</p>
            <p><strong>Phone:</strong> {{ $provider->phone }}</p>

            <p><strong>Service Types:</strong></p>
            @foreach(json_decode($provider->service_type, true) as $service)
            <span class="service-tag">{{ $service }}</span>
            @endforeach


            <!-- Buttons -->
            <div class="feedback-container">
                <button class="feedback-btn" onclick="openModal()">Add Feedback</button>
                <!-- <a href="{{ route('feedback.show', $provider->id) }}" class="reviews-btn">See Reviews</a> -->
                <form action="{{ route('feedback.show', $provider->id) }}" method="GET" style="display: inline;">
    <button type="submit" class="reviews-btn">See Reviews</button>
</form>

            
            </div>




        </div>

        <!-- Profile Image (Right Side) -->
        <img src="{{ Storage::url($provider->photo) }}" alt="{{ $provider->name }}" class="profile-img">
    </div>


    <!-- Feedback Modal -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">X</button>
            <h3>Give Feedback</h3>

            <form action="{{ route('feedback.store', $provider->id) }}" method="POST">
                @csrf

                <!-- Star Rating -->
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" required /><label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" required /><label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" required /><label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" required /><label for="star1">&#9733;</label>
                </div>

                <!-- Comment Box -->
                <textarea name="message" rows="3" placeholder="Write your feedback..." required></textarea>

                <!-- Submit Button -->
                <button type="submit" class="feedback-btn">Submit Feedback</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openModal() {
            document.getElementById("feedbackModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("feedbackModal").style.display = "none";
        }
    </script>

</body>

</html>