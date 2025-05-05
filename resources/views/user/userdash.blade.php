<!DOCTYPE html>
<html lang="en">

<head>
    @include('header.uheader')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
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
                <a href="{{ route('provider.details', $provider->id) }}" class="provider-link">
                    <div class="provider-card">
                        <div class="provider-img">
                            @if($provider->photo)
                            <img src="{{ Storage::url($provider->photo) }}" alt="{{ $provider->name }}">
                            @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Image">
                            @endif
                        </div>
                        <div class="provider-details">
                            <p>{{ $provider->name }}</p>
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
                </a>
                @endforeach
            </div>
        </div>


    </div>
    @include('footer')
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>