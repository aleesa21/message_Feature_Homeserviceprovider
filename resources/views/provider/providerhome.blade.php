<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers</title>

    <!-- Include Header -->
    @include('header.pheader')
    @include('sidebar.providersidebar.hsidebar')

    <style>
      .service-type-label {
    font-weight: bold;
    font-size: 1.2rem;
    color: #007BFF;
    margin-bottom: 10px;
    text-align: left;
}

        .content {
            padding-left:130px;
            padding-top: 50px;

        }
.heading{
    padding-left: 350px;
    color: darkblue;
}
        /* Providers Grid */
        .providers-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Provider Card */
        .provider-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            transition: 0.3s ease;
        }

        .provider-card:hover {
            transform: translateY(-5px);
        }

        /* Profile Image */
        .provider-img img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Service Badges */
        .service-badge {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            margin: 5px;
        }

        /* Provider Link */
        .provider-link {
            text-decoration: none;
            color: black;
        }

    </style>
</head>
<body>

<!-- Main Layout -->
<div class="main-container">
    <!-- Sidebar (Ensure Sidebar is Properly Styled) -->
   
    

    <!-- Main Content (Properly Aligned) -->
    <div class="content">
        <h2 class="heading">Available Service Providers</h2>

        <div class="providers-grid">
            @if($otherProviders->isEmpty())
                <p>No service providers found.</p>
            @else
                @foreach($otherProviders as $otherProvider) 
                    <a href="{{ route('pro', $otherProvider->id) }}" class="provider-link">
                        <div class="provider-card">
                            <div class="provider-img">
                                @if($otherProvider->photo)
                                    <img src="{{ Storage::url($otherProvider->photo) }}" alt="{{ $otherProvider->name }}">
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="provider-details">
                                <p><strong>{{ $otherProvider->name }}</strong></p>
                                <div class="service-type-label"><strong>Service Type:</strong></div>
                                <div class="services">
                                    @foreach (json_decode($otherProvider->service_type) as $service)
                                        <span class="service-badge">{{ $service }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>

</body>
</html>
