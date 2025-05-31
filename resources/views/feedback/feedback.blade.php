<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback for {{ $provider->name }}</title>
    <style>
        :root {
            --rating-high: #4CAF50;     /* Green */
            --rating-medium: #FFC107;   /* Yellow */
            --rating-low: #F44336;      /* Red */
            --primary-bg: #ffffff;
            --border-color: #e0e0e0;
            --text-primary: #2D3748;
            --text-secondary: #718096;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--primary-bg);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--rating-low);
            color: var(--rating-low);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .back-button:hover {
            background: var(--rating-low);
            color: white;
            transform: translateX(-3px);
        }

        .review-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .review-header h1 {
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
            font-size: 1.8rem;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .total-reviews {
            background: #f8fafc;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .filters {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.6rem 1.2rem;
            border-radius: 24px;
            border: 2px solid transparent;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
        }

        .filter-btn.active {
            border-color: currentColor;
        }

        .filter-btn[data-filter="good"] { color: var(--rating-high); }
        .filter-btn[data-filter="neutral"] { color: var(--rating-medium); }
        .filter-btn[data-filter="bad"] { color: var(--rating-low); }

        .feedback-list {
            display: grid;
            gap: 1rem;
            padding: 0;
            list-style: none;
        }

        .feedback-item {
            padding: 1.5rem;
            border-radius: 12px;
            background: var(--primary-bg);
            border: 2px solid var(--border-color);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .feedback-item.hidden {
            opacity: 0;
            transform: translateY(10px);
            height: 0;
            padding: 0;
            margin: 0;
            border: 0;
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .customer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--rating-high);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .star {
            color: var(--rating-medium);
            font-size: 1.2rem;
        }

        .star.filled { color: currentColor; }

        .feedback-message {
            color: var(--text-primary);
            line-height: 1.6;
            margin: 1rem 0;
        }

        .feedback-date {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .no-reviews {
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ url()->previous() }}" class="back-button">←</a>

    <div class="review-header">
        <h1>{{ $provider->name }}'s Reviews</h1>
        <div class="rating-summary">
            <div class="total-reviews">
                {{ $feedbacks->count() }} Total Reviews
            </div>
        </div>
    </div>

    <div class="filters">
        <button class="filter-btn active" data-filter="all">All Reviews</button>
        <button class="filter-btn" data-filter="good">Good ({{ $goodCount = $feedbacks->where('rating', '>', 3)->count() }})</button>
        <button class="filter-btn" data-filter="neutral">Neutral ({{ $neutralCount = $feedbacks->where('rating', 3)->count() }})</button>
        <button class="filter-btn" data-filter="bad">Bad ({{ $badCount = $feedbacks->where('rating', '<', 3)->count() }})</button>
    </div>

    @if($feedbacks->isEmpty())
        <div class="no-reviews">
            <p>No reviews available yet.</p>
        </div>
    @else
        <ul class="feedback-list">
            @foreach($feedbacks->sortByDesc('created_at') as $feedback)
                <li class="feedback-item"
                    data-rating="{{ $feedback->rating }}"
                    data-rating-group="@if($feedback->rating > 3)good @elseif($feedback->rating == 3)neutral @else bad @endif">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">
                                {{ strtoupper(substr($feedback->customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="customer-name">{{ $feedback->customer->name }}</div>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star @if($i <= $feedback->rating)filled @endif">
                                            @if($i <= $feedback->rating)★@else☆@endif
                                        </span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="feedback-date">
                            {{ $feedback->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    @if($feedback->message)
                        <p class="feedback-message">"{{ $feedback->message }}"</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const feedbackItems = document.querySelectorAll('.feedback-item');

    console.log('Filter Buttons:', filterButtons);
    console.log('Feedback Items:', feedbackItems);

    // Show all reviews on initial load
    filterButtons.forEach(button => {
        if (button.dataset.filter === 'all') {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });
    feedbackItems.forEach(item => item.classList.remove('hidden'));

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            console.log('Clicked Filter:', filter);

            // Update active button state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            feedbackItems.forEach(item => {
                const rating = parseInt(item.dataset.rating);
                let shouldShow = false;

                if (filter === 'all') {
                    shouldShow = true;
                } else if (filter === 'good' && rating > 3) {
                    shouldShow = true;
                } else if (filter === 'bad' && rating < 3) {
                    shouldShow = true;
                } else if (filter === 'neutral' && rating === 3) {
                    shouldShow = true;
                }

                item.classList.toggle('hidden', !shouldShow);
                console.log('Feedback Item:', item, 'Rating:', rating, 'Should Show:', shouldShow);
            });
        });
    });
});
</script>
</body>
</html>