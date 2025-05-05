<!DOCTYPE html>
<html lang="en">

<head>
    @include('header.header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <div class="main">
        <div class="carousel">
            <div class="carousel-track">
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel/back5.png') }}" alt="carousel pic">
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="services-section">
            <div class="services-grid">
                <div class="service-card">
                    <img src="{{ asset('images/icons/plumbing.png') }}" alt="Service 1">
                    <span>Plumber</span>

                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/electrician.png') }}" alt="Service 2">
                    <span>Electrician</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/carpenter.png') }}" alt="Service 3">
                    <span>Carpenter</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/painter.png') }}" alt="Service 4">
                    <span>Painter</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/welder.png') }}" alt="Service 5">
                    <span>Welder</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/gardener.png') }}" alt="Service 6">
                    <span>Gardener</span>
                </div>
            </div>
        </div>
        <!-- Available Service Providers Section -->
        <div class="providers-section">
            <h2>Available Service Providers</h2>
            <div class="providers-grid">
                @foreach($providers as $provider)
                <div class="provider-card">
                    <div class="provider-img">
                        @if($provider->photo)
                        <img src="{{ Storage::url($provider->photo) }}" alt="{{ $provider->name }}">
                        <!-- <img src="{{ asset('storage/profile_photos/' . $provider->photo) }}" alt="Profile Photo" class="profile-photo"> -->
                        @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <span class="login-message">
                        <a href="{{ route('login', ['redirect' => route('provider.details', ['id' => $provider->id])]) }}" class="login-link">
                            Login to see More Details
                        </a>

                        <!-- <a href="{{ route('login') }}" class="login-link">Login to see More Details</a> -->
                    </span>
                    <div class="provider-details">
                        <h3>{{ $provider->name }}</h3>
                        <!-- <p><span>Email: </span>{{ $provider->email }}</p> -->
                        <p class="phone">
                            <span>Phone: </span>
                            xxx-xxxxxxx


                        </p>
                        <p><span>Address: </span>{{ $provider->address }}</p>
                        <!-- <p><span>Service Type: </span>{{ $provider->service_type }}</p> -->
                        @if($provider->service_type)
                        <div class="service-type-label">Service Type:</div>
                        <div class="service-types"> <!-- This container will hold the service badges -->
                            @foreach(json_decode($provider->service_type, true) as $service)
                            <div class="service-type">{{ $service }}</div>
                            @endforeach
                        </div>
                        @endif


                    </div>


                </div>
                @endforeach
            </div>
        </div>


    </div>
    @include('footer')
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>