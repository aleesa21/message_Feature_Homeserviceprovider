<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>

    <style>
    body,
    html {
        margin: 0;
        padding: 0;
        font-family: Calibri, sans-serif;
    }

    body {
        padding-top: 70px; /* So content doesn't go under fixed navbar */
    }

    * {
        text-decoration: none;
        box-sizing: border-box;
    }

    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background: #32353c;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar .logo a {
        font-size: 25px;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
    }

    .navbar .logo a:hover {
        color: #ff8c00;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-left: 20px; /* Adjust spacing */
    }

    .nav-links a {
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: #ff8c00;
    }

    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar input {
        padding: 6px 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
        outline: none;
        width: 200px;
    }

    .search-bar button {
        background-color: #1588fc;
        color: white;
        border: none;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .suggestions-box {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid #ccc;
        width: 200px;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .suggestions-box div {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
    }

    .suggestions-box div:hover {
        background: #f0f0f0;
    }

    .user-dropdown {
        position: relative;
    }

    .user-dropdown-toggle {
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .user-dropdown-content {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #44474e;
        border: 1px solid #666;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 10;
        display: none;
        min-width: 120px;
        padding: 10px 0;
        margin-top: 5px;
    }

    .user-dropdown-content a {
        display: block;
        padding: 8px 15px;
        text-decoration: none;
        color: white; /* Changed text color to white */
        font-size: 14px;
        text-align: left;
        border: none;
        background-color: #1588fc; /* Blue background color */
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 5px; /* Add border-radius for the button look */
        font-weight: bold; /* Make the text bold like the Logout button */
        margin-bottom: 5px; /* Add a little spacing between buttons */
    }

    .user-dropdown-content a:hover {
        background-color: #1167b1; /* Darker blue on hover */
        color: white; /* Keep text white on hover */
    }

    .user-dropdown-content button {
        display: block;
        padding: 8px 15px;
        text-decoration: none;
        color: #eee;
        font-size: 14px;
        text-align: left;
        border: none;
        background-color: red; /* Red background for Logout button */
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 5px; /* Add border-radius for the button */
        font-weight: bold;
        margin-top: 5px; /* Add a little spacing between buttons */
    }

    .user-dropdown-content button:hover {
        background-color: darkred;
    }

    .user-dropdown.open .user-dropdown-content {
        display: block;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .nav-links {
            margin-left: 0;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .search-bar {
            margin-left: 0;
            width: 100%;
        }

        .right-section {
            width: 100%;
            justify-content: space-between; /* Distribute user info and dropdown */
        }

        .user-dropdown {
            position: static; /* Adjust for smaller screens */
        }

        .user-dropdown-content {
            position: static;
            border: none;
            box-shadow: none;
            margin-top: 0;
            width: 100%;
        }
    }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="/userdash">Home Service Provider</a>
        </div>

        <div class="nav-links">
            <a href="#"></a>
        </div>

        <form class="search-bar" action="{{ route('search') }}" method="GET">
            <input type="text" id="search-input" name="query" placeholder="Search services..." autocomplete="off">
            <button type="submit">Search</button>
            <div id="suggestions" class="suggestions-box"></div>
        </form>

        <div class="right-section">
            <div class="user-dropdown">
                <div class="user-dropdown-toggle">
                    <span><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
                </div>
                <div class="user-dropdown-content">
                    <a href="{{ route('user.messages') }}">Messages</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.user-dropdown-toggle').click(function() {
                $('.user-dropdown').toggleClass('open');
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('.user-dropdown').length) {
                    $('.user-dropdown').removeClass('open');
                }
            });

            var searchRoute = "{{ route('search.suggestions') }}";
            let debounceTimer;

            $('#search-input').on('input', function() {
                clearTimeout(debounceTimer);
                let query = $(this).val().trim();

                if (query.length > 1) {
                    debounceTimer = setTimeout(() => {
                        $.ajax({
                            url: searchRoute,
                            type: "GET",
                            data: { query: query },
                            success: function(data) {
                                let suggestions = $('#suggestions');
                                suggestions.empty().fadeIn();

                                if (Array.isArray(data) && data.length > 0) {
                                    if (data.includes(query)) {
                                        suggestions.append(`<div class="suggestion-item">${query}</div>`);
                                    } else {
                                        data.forEach(service => {
                                            suggestions.append(`<div class="suggestion-item">${service}</div>`);
                                        });
                                    }
                                } else {
                                    suggestions.append('<div class="no-results">No results found</div>');
                                }
                            },
                            error: function() {
                                $('#suggestions').empty().append('<div class="no-results">Error fetching data</div>').fadeIn();
                            }
                        });
                    }, 300);
                } else {
                    $('#suggestions').fadeOut();
                }
            });

            // Handle click on suggestion
            $(document).on('click', '.suggestion-item', function() {
                $('#search-input').val($(this).text());
                $('#suggestions').fadeOut();
            });

            // Hide suggestions when clicking outside
            $(document).click(function(e) {
                if (!$('#search-input').is(e.target) && !$('#suggestions').is(e.target) && $('#suggestions').has(e.target).length === 0) {
                    $('#suggestions').fadeOut();
                }
            });
        });
    </script>
</body>
</html>