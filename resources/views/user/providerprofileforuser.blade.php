<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $provider->name }} - Details</title>
    @include('header.uheader')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .half-background {
            position: fixed;
            width: 100%;
            height: 40vh;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            z-index: -1;
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
        }

        .profile-card {
            width: 900px; /* Slightly wider to accommodate more content */
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: grid; /* Changed to grid for better layout control */
            grid-template-columns: 2fr 1fr; /* Two columns: info takes 2/3, image 1/3 */
            gap: 2.5rem; /* Increased gap for more breathing room */
            position: relative; 
            margin-top: 60px;
            padding: 2.5rem; /* Adjusted padding */
            align-items: start; /* Align items to the start of their grid area */
        }

        .back-button {
            position: absolute;
            top: 1rem; 
            left: 1rem;
            padding: 0.6rem 0.8rem; 
            border: none;
            border-radius: 8px;
            background-color: #cbd5e1;
            color: #4b5563;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center; 
            z-index: 10; 
        }

        .back-button:hover {
            background-color: #9ca3af;
        }

        .profile-img {
            width: 100%; /* Make image responsive within its grid area */
            max-width: 300px; /* Max width for the image */
            height: auto; /* Maintain aspect ratio */
            border-radius: 15px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            grid-column: 2 / 3; /* Place image in the second column */
            grid-row: 1 / span 2; /* Span multiple rows if needed, or align to start */
            margin-left: auto; /* Push image to the right if space allows */
            margin-right: 0;
        }

        .profile-info {
            grid-column: 1 / 2; /* Place info in the first column */
            padding-right: 1rem;
        }

        h2 {
            color: #1f2937;
            font-size: 2.2rem; /* Slightly larger heading */
            margin-bottom: 1.2rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 60px; /* Slightly wider underline */
            height: 4px; /* Thicker underline */
            background: #6366f1;
            border-radius: 2px; /* Soften the corners */
        }

        p {
            color: #4b5563;
            margin: 0.9rem 0; /* Slightly more vertical spacing */
            font-size: 1.05rem; /* Slightly larger text */
            line-height: 1.6; /* Better readability for paragraphs */
        }

        p strong {
            color: #1f2937;
            min-width: 110px; /* Increased min-width for labels */
            display: inline-block;
            font-weight: 600; /* Make labels bolder */
        }

        .description {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb; /* Separator for description */
        }

        .description p {
            color: #374151; /* Darker text for description */
        }

        .service-types-heading {
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            color: #1f2937;
            font-weight: 600;
        }

        .service-tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem; /* Spacing between tags */
            margin-bottom: 2rem; /* Space before buttons */
        }

        .service-tag {
            background: #e0e7ff;
            color: #6366f1;
            padding: 0.6rem 1.2rem; /* Slightly larger padding for tags */
            border-radius: 25px; /* More rounded corners */
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-block;
            border: 1px solid #c7d2fe;
            transition: all 0.2s ease; /* Smooth hover effect */
        }

        .service-tag:hover {
            background: #c7d2fe;
            border-color: #6366f1;
            transform: translateY(-2px);
        }

        .feedback-container {
            margin-top: 2rem;
            display: flex;
            gap: 1.2rem; /* Increased gap between buttons */
            flex-wrap: wrap;
        }

        .feedback-btn, .reviews-btn, .btn-primary {
            padding: 0.9rem 1.6rem; /* Slightly larger buttons */
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600; /* Bolder button text */
            display: inline-flex;
            align-items: center;
            gap: 0.6rem; /* Increased gap for icon and text */
            font-size: 1rem;
        }

        .feedback-btn {
            background: #6366f1;
            color: white;
        }

        .reviews-btn {
            background: #10b981;
            color: white;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }

        .feedback-btn:hover, .reviews-btn:hover, .btn-primary:hover {
            transform: translateY(-3px); /* More pronounced lift on hover */
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* Stronger shadow */
        }

        /* Modern Modal Styles (remain mostly the same) */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px); /* Slightly stronger blur */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 2.5rem; /* Increased modal padding */
            border-radius: 15px;
            width: 90%;
            max-width: 450px; /* Slightly wider modal */
            position: relative;
            animation: modalSlide 0.3s ease forwards; /* Added forwards to keep final state */
        }

        @keyframes modalSlide {
            from { transform: translateY(-70px); opacity: 0; } /* More movement */
            to { transform: translateY(0); opacity: 1; }
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #ef4444;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem; /* Larger 'x' */
        }

        .close-btn:hover {
            transform: rotate(180deg); /* Full spin */
            background: #dc2626;
        }

        .star-rating {
            display: flex;
            justify-content: center;
            gap: 0.6rem; /* Increased gap */
            margin: 1.8rem 0; /* More vertical spacing */
        }

        .star-rating label {
            font-size: 2.5rem; /* Larger stars */
            color: #cbd5e1;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }

        textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            margin: 1.2rem 0; /* Adjusted margins */
            resize: vertical;
            min-height: 120px; /* Taller textarea */
            font-size: 1rem;
        }

        /* Request Service Modal Enhancements (remain similar, but with adjustments) */
        .request-modal-content {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            max-width: 550px; /* Slightly wider for form inputs */
        }

        .request-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem; /* More space below header */
        }

        .request-modal-header h3 {
            font-size: 1.8rem; /* Larger heading */
            color: #1f2937;
        }

        .request-modal-content label {
            display: block; /* Make labels block level for better spacing */
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .request-modal-content input,
        .request-modal-content textarea {
            width: 100%;
            padding: 0.9rem; /* Slightly more padding */
            margin-bottom: 1.5rem; /* More space between inputs */
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
            font-size: 1rem;
        }

        .request-modal-content input:focus,
        .request-modal-content textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); /* Focus ring */
            outline: none;
        }

        @media (max-width: 900px) { /* Adjust breakpoint for larger cards */
            .profile-card {
                grid-template-columns: 1fr; /* Stack columns on smaller screens */
                width: 95%;
                margin-top: 40px;
                padding-top: 5rem;
                gap: 2rem;
            }

            .profile-img {
                grid-column: 1 / 2; /* Reset image to first column for stacking */
                grid-row: auto; /* Auto row placement */
                margin: 0 auto; /* Center image when stacked */
                max-width: 280px; /* Adjust max width for smaller screens */
            }

            .profile-info {
                grid-column: 1 / 2; /* Info takes full width */
                padding-right: 0; /* Remove extra padding */
            }

            h2 {
                font-size: 1.8rem;
            }

            p {
                font-size: 0.95rem;
            }

            .feedback-container {
                flex-direction: column; /* Stack buttons on very small screens */
                gap: 1rem;
            }

            .feedback-btn, .reviews-btn, .btn-primary {
                width: 100%; /* Full width buttons */
            }
        }

        @media (max-width: 500px) {
            .profile-card {
                padding: 1.5rem; /* Reduce padding on smallest screens */
            }
            .back-button {
                top: 0.5rem; 
                left: 0.5rem; 
                padding: 0.4rem 0.6rem; 
            }
            h2 {
                font-size: 1.5rem;
            }
            .modal-content, .request-modal-content {
                padding: 1.5rem;
            }
        }

    </style>
</head>

<body>
    <div class="half-background"></div>
    <a href="/userdash" class="back-button" style="top: 70px;"> ← Back </a>
    <div class="profile-card">
        
        <div class="profile-info">
            <h2>{{ $provider->name }}</h2>
            <p><strong>Address:</strong> {{ $provider->address }}</p>
            <p><strong>Email:</strong> {{ $provider->email }}</p>
            <p><strong>Phone:</strong> {{ $provider->phone }}</p>

            {{-- New: Add a Description Field --}}
            @if(isset($provider->description) && !empty($provider->description))
            <div class="description">
                <p><strong>About:</strong></p>
                <p>{{ $provider->description }}</p>
            </div>
            @endif

            <h3 class="service-types-heading">Service Types:</h3>
            <div class="service-tags-container">
                @foreach(json_decode($provider->service_type, true) as $service)
                <span class="service-tag">{{ $service }}</span>
                @endforeach
            </div>

            <div class="feedback-container">
                <button class="feedback-btn" onclick="openModal()">✨ Add Feedback</button>
                <form action="{{ route('feedback.show', $provider->id) }}" method="GET" style="display: inline;">
                    <button type="submit" class="reviews-btn">📝 See Reviews</button>
                </form>
                <button class="btn btn-primary" onclick="openRequestForm()">📅 Request Service</button>
            </div>
        </div>

        <img src="{{ Storage::url($provider->photo) }}" alt="{{ $provider->name }}" class="profile-img">
    </div>

    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">×</button>
            <h3>Give Feedback</h3>
            <form action="{{ route('feedback.store', $provider->id) }}" method="POST">
                @csrf
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4" required /><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3" required /><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2" required /><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1" required /><label for="star1">★</label>
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
                <button type="button" class="close-btn" onclick="closeRequestForm()">×</button>
            </div>
            <form action="{{ route('service.request.submit', $provider->id) }}" method="POST">
                @csrf
                <label for="service_details">Service Details:</label>
                <textarea id="service_details" name="service_details" rows="5" placeholder="Describe the service you need..." required></textarea>

                <label for="preferred_time">Preferred Time:</label>
                <input type="datetime-local" id="preferred_time" name="preferred_time">

                <label for="contact_info">Contact Info:</label>
                <input type="text" id="contact_info" name="contact_info" placeholder="Your name and contact number..." required>

                <button type="submit" class="btn-primary">Submit Request</button>
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