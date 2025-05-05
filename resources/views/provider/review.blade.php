<!DOCTYPE html>
<html lang="en">
<head>
    @include('header.pheader') 
    <style>
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
            background: #111;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 60px;
        }

        .main-content {
            margin-left: 250px;
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

        .filter-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-buttons button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .all { background-color: #3498db; }
        .good { background-color: #28a745; }
        .neutral { background-color: #f39c12; }
        .bad { background-color: #e74c3c; }

        .feedback-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .good-review { border-left: 5px solid #28a745; }
        .neutral-review { border-left: 5px solid #f39c12; }
        .bad-review { border-left: 5px solid #e74c3c; }
    </style>
</head>
<body>

    @include('header.pheader') 

    <div class="content-wrapper">
        <div class="sidebar">
            @include('sidebar.providersidebar.rsidebar')
        </div>

        <div class="main-content">
            <div class="container">
                <h2>Reviews</h2>
                
                <div class="filter-buttons">
                    <button class="all" onclick="filterReviews('all')">All Reviews</button>
                    <button class="good" onclick="filterReviews('good')">Good Reviews</button>
                    <button class="neutral" onclick="filterReviews('neutral')">Neutral Reviews</button>
                    <button class="bad" onclick="filterReviews('bad')">Bad Reviews</button>
                </div>
                
                @if($feedbacks->isEmpty())
                    <p class="text-gray-500 text-center">No feedback yet.</p>
                @else
                    <ul class="feedback-list">
                        @foreach($feedbacks->sortByDesc('created_at') as $feedback)
                            <li class="feedback-item 
                                @if ($feedback->rating >= 4) good-review
                                @elseif ($feedback->rating == 3) neutral-review
                                @else bad-review @endif">
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

    <script>
        function filterReviews(type) {
            let reviews = document.querySelectorAll('.feedback-item');
            reviews.forEach(review => {
                review.style.display = 'none';
                if (type === 'all' || 
                    (type === 'good' && review.classList.contains('good-review')) ||
                    (type === 'neutral' && review.classList.contains('neutral-review')) ||
                    (type === 'bad' && review.classList.contains('bad-review')))
                {
                    review.style.display = 'block';
                }
            });
        }
    </script>

</body>
</html>
