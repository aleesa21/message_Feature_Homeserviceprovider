<!DOCTYPE html>
<html lang="en">

<head>
    @include('header.pheader')
    @include('sidebar.providersidebar.psidebar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/providerdash.css') }}">
</head>

<body>
    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-wrapper">
    <!-- Left Sidebar (Profile Image + Name) -->
    <div class="profile-sidebar">
        <div class="profile-image">
            @if($provider->photo)
                <img src="{{ Storage::url($provider->photo) }}" alt="Profile Image">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Image">
            @endif
        </div>
        <h3 class="provider-name">{{ $provider->name }}</h3>
    </div>

    <!-- Right Side: Profile Details -->
    <div class="profile-details">
        <h2 class="profile-title">Profile Details</h2>
        
        <div class="info-group">
            <label>Address:</label>
            <p>{{ $provider->address }}</p>
        </div>
        <div class="info-group">
            <label>Email:</label>
            <p>{{ $provider->email }}</p>
        </div>
        <div class="info-group">
            <label>Phone:</label>
            <p>{{ $provider->phone }}</p>
        </div>

        <h3 class="section-title">Service Types</h3>
        <div class="service-types">
            @if($provider->service_type)
                @foreach(json_decode($provider->service_type, true) as $service)
                    <span class="service-badge">{{ $service }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>

    </div>
    
</body>
</html>
