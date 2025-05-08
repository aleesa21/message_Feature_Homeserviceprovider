<!DOCTYPE html>
<html lang="en">

<head>
    @include('header.phomeheader')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Home</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <style>
        .providers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .provider-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .provider-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
        }

        .provider-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .provider-details p {
            margin-bottom: 5px;
        }

        .service-types {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
            margin-top: 5px;
        }

        .service-type {
            background-color: #f0f0f0;
            color: #333;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .provider-link {
            text-decoration: none;
            color: inherit;
        }

        .providers-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .service-type-label {
            font-weight: bold;
            margin-bottom: 3px;
        }
    </style>
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

        <div class="services-section">
            <div class="services-grid">
                <div class="service-card">
                    <img src="{{ asset('images/icons/plumbing.png') }}" alt="Plumbing">
                    <span>Plumbing</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/electrician.png') }}" alt="Electrician">
                    <span>Electrician</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/carpenter.png') }}" alt="Carpenter">
                    <span>Carpenter</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/painter.png') }}" alt="Painter">
                    <span>Painter</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/welder.png') }}" alt="Welder">
                    <span>Welder</span>
                </div>
                <div class="service-card">
                    <img src="{{ asset('images/icons/gardener.png') }}" alt="Gardener">
                    <span>Gardener</span>
                </div>
            </div>
        </div>

        <div class="providers-section">
            <h2>Other Available Service Providers</h2>
            <div class="providers-grid">
                @forelse($otherProviders as $otherProvider)
                <a href="{{ route('provider.details', $otherProvider->id) }}" class="provider-link">
                    <div class="provider-card">
                        <div class="provider-img">
                            @if($otherProvider->photo)
                            <img src="{{ Storage::url($otherProvider->photo) }}" alt="{{ $otherProvider->name }}">
                            @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Image">
                            @endif
                        </div>
                        <div class="provider-details">
                            <p>{{ $otherProvider->name }}</p>
                            @if($otherProvider->service_type)
                            <div class="service-type-label">Service Type:</div>
                            <div class="service-types">
                                @foreach(json_decode($otherProvider->service_type, true) as $service)
                                <div class="service-type">{{ $service }}</div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <p>No other service providers available at the moment.</p>
                @endforelse
            </div>
        </div>
    </div>
    @include('footer')
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>