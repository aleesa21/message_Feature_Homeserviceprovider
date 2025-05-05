<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback for {{ $provider->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
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
            font-size: 18px;
        }
        .feedback-list {
            list-style: none;
            padding: 0;
        }
        .feedback-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #f39c12;
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
    </style>
</head>
<body>

<div class="container">
    <!-- Close Button -->
    <button class="close-btn" onclick="history.back()">X</button>

    <h2>Feedback for {{ $provider->name }}</h2>

    <!-- Calculate Average Rating -->
    @php
        $totalFeedbacks = $feedbacks->count();
        $averageRating = $totalFeedbacks > 0 ? round($feedbacks->avg('rating'), 1) : 0;
    @endphp

    <!-- Display Average Rating -->
    <div class="average-rating">
        Overall Rating: {{ $averageRating }} 
        <span class="stars">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $averageRating)
                    ★
                @else
                    ☆
                @endif
            @endfor
        </span>
    </div>

    @if($feedbacks->isEmpty())
        <p class="text-gray-500 text-center">No feedback yet.</p>
    @else
        <ul class="feedback-list">
            @foreach($feedbacks->sortByDesc('created_at') as $feedback)
                <li class="feedback-item">
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

</body>
</html>
