<!DOCTYPE html> 
<html lang="en">
<head>
    <style>
        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .content-wrapper {
            display: flex;
            flex-grow: 1;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 60px;
        }

        .main-content {
            margin-left: 130px;
            padding: 20px;
            flex-grow: 1;
            background: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn:hover {
            background: #c0392b;
        }

        .average-rating {
            text-align: center;
            font-size: 18px;
            margin-bottom: 15px;
            color: #f39c12;
            font-weight: bold;
        }

        .stars {
            color: #f39c12;
            font-size: 20px;
        }

        .feedback-list {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        .feedback-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .feedback-item.bad {
            border-left: 5px solid #e74c3c;
            background-color: #f8d7da;
        }

        .feedback-item.good {
            border-left: 5px solid #28a745;
            background-color: #d4edda;
        }

        .feedback-item.neutral {
            border-left: 5px solid #ffc107;
            background-color: #fff3cd;
        }

        .customer-name {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .feedback-message {
            color: #555;
            margin: 5px 0;
        }

        .feedback-date {
            font-size: 12px;
            color: #888;
        }

        /* Filter Buttons Styling */
        .filter-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-buttons a {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            background-color: #3498db;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .filter-buttons a:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        /* Active Button Styles */
        .filter-buttons a.active {
            background-color: #2ecc71;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .filter-buttons a.bad {
            background-color: #e74c3c;
        }

        .filter-buttons a.good {
            background-color: #28a745;
        }

        .filter-buttons a.neutral {
            background-color: #f39c12;
        }
    </style>
</head>
<body>

    <div class="content-wrapper">
        <div class="sidebar">
            <!-- Sidebar (if you have any) -->
        </div>

        <div class="main-content">
            <div class="container">
            <a href="{{ route('adashpprofile') }}" class="close-btn">X</a>

                <!-- <button class="close-btn" onclick="history.back()">X</button> -->

                <h2>Reviews for {{ $provider->name }}</h2>

                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <a href="{{ route('admin.review', ['providerId' => $provider->id, 'filter' => 'bad']) }}" 
                       class="bad {{ request()->get('filter') == 'bad' ? 'active' : '' }}">
                       Bad Reviews
                    </a>
                    <a href="{{ route('admin.review', ['providerId' => $provider->id, 'filter' => 'good']) }}" 
                       class="good {{ request()->get('filter') == 'good' ? 'active' : '' }}">
                       Good Reviews
                    </a>
                    <a href="{{ route('admin.review', ['providerId' => $provider->id, 'filter' => 'neutral']) }}" 
                       class="neutral {{ request()->get('filter') == 'neutral' ? 'active' : '' }}">
                       Neutral Reviews
                    </a>
                    <a href="{{ route('admin.review', ['providerId' => $provider->id]) }}" 
                       class="btn btn-secondary {{ request()->get('filter') == null ? 'active' : '' }}">
                       All Reviews
                    </a>
                </div>

                @if($feedbacks->isEmpty())
                    <p class="text-gray-500 text-center">No reviews yet.</p>
                @else
                    <ul class="feedback-list">
                        @foreach($feedbacks as $feedback)
                            <li class="feedback-item 
                                @if ($feedback->rating <= 2) bad 
                                @elseif ($feedback->rating == 3) neutral 
                                @else good @endif">

                                <div class="customer-name">{{ $feedback->customer->name }}</div>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                                <p class="feedback-message">{{ $feedback->message }}</p>
                                <small class="feedback-date">{{ $feedback->created_at->format('d M Y') }}</small>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
