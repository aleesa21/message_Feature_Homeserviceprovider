<!DOCTYPE html>
<html lang="en">

<head>
    @include('header.pheader')
    @include('sidebar.providersidebar.esidebar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Profile Update</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 130px;
        }

        /* Container */
        .container {
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        /* Form Header */
        /* Form Header */
h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: blueviolet;
    text-align: center;

    
}


        /* Form Labels */
        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #555;
        }

        /* Input Fields */
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 1em;
            background-color: #f8f9fa;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            background-color: #fff;
        }

        /* Service Type Container */
        #service-type-container {
            margin-top: 10px;
        }

        /* Service Input Box */
        .service-input {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 8px;
            background: white;
            transition: 0.3s;
        }

        .service-input input {
            flex-grow: 1;
            border: none;
            font-size: 1em;
            background: none;
            outline: none;
        }

        /* Add & Remove Buttons */
        .service-btn {
            border: none;
            padding: 6px 12px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        /* Submit Button */
        button[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }

        /* Profile Photo */
        .profile-photo {
            margin-top: 10px;
            width: 80px;
            height: 80px;
            border-radius: 0%;
            object-fit: cover;
        }

        /* File Input */
        input[type="file"] {
            border: none;
            padding: 5px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }


        /* General Input Fields (Name, Email, Address) */
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background: #fff;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        /* Service Types Container */
        #service-type-container {
            margin-top: 10px;
        }

        /* Individual Service Input */
        .service-input {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 8px;
        }

        /* Service Input Field */
        .service-input input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 16px;
            background: transparent;
        }

        /* Add and Remove Buttons */
        .add-service,
        .remove-service {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 5px 10px;
            font-weight: bold;
        }

        .add-service {
            color: green;
        }

        .remove-service {
            color: red;
        }
       

        
    </style>
</head>

<body>

    <div class="container">
    <h2 class="abc">Edit Profile</h2>



        <form action="{{ route('provider.profile.update', ['id' => $provider->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $provider->name) }}">
            <!-- Phone -->
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $provider->phone) }}">


            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $provider->email) }}">

            <!-- Address -->
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ old('address', $provider->address) }}">

            <!-- <label for="service_type">Service Types</label>
            <div id="service-type-container">
                @php
                // Decode the service_type field or default to an empty array
                $serviceTypes = json_decode($provider->service_type ?? '[]', true);
                if (!is_array($serviceTypes)) {
                $serviceTypes = [];
                }
                @endphp

                @foreach($serviceTypes as $service)
                <div class="service-input">
                    <input type="text" name="service_type[]" value="{{ trim($service) }}" placeholder="Enter service type">
                    <button type="button" class="remove-service">-</button>
                </div>
                @endforeach
            </div>
            <button type="button" id="add-service">+</button> -->
            <label for="service_type">Service Types</label>
            <div id="service-type-container">
                @php
                $serviceTypes = json_decode($provider->service_type ?? '[]', true);
                if (!is_array($serviceTypes)) {
                $serviceTypes = [];
                }
                @endphp

                @foreach($serviceTypes as $index => $service)
                <div class="service-input">
                    <input type="text" name="service_type[]" value="{{ trim($service) }}" placeholder="Enter service type">
                    @if($index == 0)
                    <button type="button" class="add-service">+</button>
                    @endif
                    <button type="button" class="remove-service">-</button>
                </div>
                @endforeach
            </div>







            <!-- Photo -->
            <label for="photo">Profile Photo</label>
            <input type="file" id="photo" name="photo">
            @if($provider->photo)
            <img src="{{ Storage::url($provider->photo) }}" alt="Profile Image" class="profile-photo">
            @endif
            <!-- Submit Button -->
            <button type="submit">Save Changes</button>

        </form>
    </div>
    <script src="{{ asset('js/providerprofileupdate.js') }}"></script>

</body>

</html>