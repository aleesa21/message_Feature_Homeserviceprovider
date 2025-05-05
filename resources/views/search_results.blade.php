<!-- resources/views/search_results.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 0;
        }

        .search-results {
            margin: 20px;
        }

        .search-results ul {
            list-style-type: none;
            padding: 0;
        }

        .search-results li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
        }

        .search-results li a {
            text-decoration: none;
            font-size: 18px;
            color: #333;
        }

        .search-results li a:hover {
            color: #1588fc;
        }
        /* Add styles for the services section */
.services-section {
    position: relative;
    top: -80px; /* Adjust this value to float above the carousel */
    background-color: #fff;
    margin: 0 auto;
    padding: 20px;
    width: 90%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    text-align: center;
}

.services-grid {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.service-card {
    width: 120px;
    text-align: center;
    color: #333;
    font-size: 14px;
}

.service-card img {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
}

.service-card span {
    display: block;
    margin-top: 5px;
    font-weight: bold;
}
/*wlcome page ko available service provider ko css*/

/* Providers Section styling remains the same */
.providers-section {
    text-align: center;
    padding: 20px;
    margin-top: -90px; 
}

.providers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Increase card width */
    gap: 20px;
    justify-content: center;
}

.provider-card {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    transition: transform 0.3s ease;
    width: 280px; /* Increase card size */
    position: relative;  /* Required for positioning the message */
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
}

.provider-card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.provider-img img {
    width: 100%; /* Make image take full width */
    height: 180px; /* Adjust image height */
    object-fit: cover; /* Ensure the image fits properly */
    border-radius: 10px;
}

.provider-details {
    display: flex;
    flex-direction: column;
    padding: 12px;
    text-align: left;
}

.provider-details h3 {
    font-size: 16px;
    margin-bottom: 6px;
}

.provider-details p {
    font-size: 14px;
    margin: 4px 0;
}
/* Styling for the login message */
.login-message {
    display: none;
    position: absolute;
    background-color: #f8d7da; 
    color: #721c24; 
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    margin-top: 5px;
    width: max-content;
    text-align: center;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}
.provider-card:hover .login-message {
    display: block;  /* Make it visible on hover */
}
.login-link {
    color: #f0f8ff;  /* Light color for the link */
    text-decoration: underline;
}
/* Show the login message when hovering over the phone number */
.phone:hover .login-message {
    display: block;
}

/* Styling for the login link */
.login-link {
    color: red;
    text-decoration: none;
    font-weight: bold;
}
/* Service Type Label */
.service-type-label {
    font-weight: bold;
    font-size: 1.2rem;
    color: #007BFF;
    margin-bottom: 10px;
}

/* Container to hold service badges */
.service-types {
    display: flex;                
    flex-wrap: nowrap;            
    gap: 10px;                    
    overflow: hidden;           
}

/* Service Badge */
.service-type {
    background: linear-gradient(135deg, #007bff, #0044cc); /* Gradient background */
    color: white;
    padding: 5px 12px;           /* Adjust padding for text fitting */
    border-radius: 20px;         /* Rounded corners */
    font-size: 13px;
    font-weight: 500;
    transition: background 0.3s ease-in-out;
}

/* Hover effect */
.service-type:hover {
    background: linear-gradient(135deg, #0056b3, #003399); /* Darker gradient on hover */
}



    </style>
</head>

<body>
    <div class="search-results">
        <h2>Search Results</h2>
        <ul>
            @if($users->isEmpty())
                <li>No results found.</li>
            @else
                <!-- @foreach($users as $user)
                    <li>
                        <a href="#">{{ $user->name }}</a>
                        <br>
                        Service Type: {{ $user->service_type }}<br>
                        Location: {{ $user->address }}
                    </li>
                @endforeach -->
                <div class="providers-grid">
                @foreach($users as $users)
                <div class="provider-card">
                    <div class="provider-img">
                        @if($users->photo)
                        <img src="{{ Storage::url($users->photo) }}" alt="{{ $users->name }}">
                        @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <span class="login-message">
                        <a href="{{ route('login', ['redirect' => route('provider.details', ['id' => $users->id])]) }}" class="login-link">
                            Login to see More Details
                        </a>

                    </span>
                    <div class="provider-details">
                        <h3>{{ $users->name }}</h3>
                        <p class="phone">
                            <span>Phone: </span>
                            xxx-xxxxxxx


                        </p>
                        <p><span>Address: </span>{{ $users->address }}</p>
                        @if($users->service_type)
                        <div class="service-type-label">Service Type:</div>
                        <div class="service-types"> <!-- This container will hold the service badges -->
                            @foreach(json_decode($users->service_type, true) as $service)
                            <div class="service-type">{{ $service }}</div>
                            @endforeach
                        </div>
                        @endif


                    </div>


                </div>
                @endforeach
            </div>




            @endif
        </ul>
    </div>
</body>

</html>
