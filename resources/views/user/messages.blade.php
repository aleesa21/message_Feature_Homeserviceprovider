<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Service Requests</title>
    @include('header.uheader') {{-- Assuming you have a user header --}}
    {{-- Include user sidebar if you have one --}}
    <style>
        .main-content {
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 25px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border-bottom: 1px solid #e0e0e0;
            padding: 14px 16px;
            text-align: left;
        }
        th {
            background-color: #343a40; /* Darker header */
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        tbody tr:hover {
            background-color: #f5f5f5; /* Subtle hover effect */
        }
        .status-accepted { color: #28a745; font-weight: 500; }
        .status-rejected { color: #dc3545; font-weight: 500; }
        .status-pending { color: #ffc107; font-weight: 500; }
        .button {
            display: inline-block;
            padding: 10px 18px;
            margin-top: 5px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            font-size: 0.95em;
            transition: background-color 0.2s ease-in-out;
            border: 1px solid transparent;
        }
        .button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-muted {
            color: #6c757d;
            font-size: 0.9em;
        }
        .home-button {
            display: inline-block;
            padding: 10px 18px;
            margin-top: 20px;
            text-decoration: none;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            font-size: 0.95em;
            transition: background-color 0.2s ease-in-out;
            border: 1px solid transparent;
        }
        .home-button:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body>
    {{-- @include('sidebar.user.sidebar') --}}
    <div class="main-content">
        <h1>Your Service Requests</h1>
        @if ($requests->isEmpty())
            <p class="text-center">You haven't submitted any service requests yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Submitted On</th>
                        <th>Provider</th>
                        <th>Status</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->service_details }}</td>
                            <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if ($request->provider)
                                    {{ $request->provider->name }}
                                @else
                                    <span class="text-muted">Not assigned</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-{{ strtolower($request->status) }}">{{ ucfirst($request->status) }}</span>
                            </td>
                            <td style="text-align: center;">
                                @if ($request->status === 'accepted' && $request->provider_id)
                                    <a href="{{ route('chat.show', $request->id) }}" class="button">Chat</a>
                                @elseif ($request->status === 'pending' && !$request->provider_id)
                                    <span class="text-muted">Waiting</span>
                                @elseif ($request->status === 'rejected')
                                    <span class="text-muted">Rejected</span>
                                @elseif ($request->status === 'completed')
                                    <span class="text-muted">Completed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div style="text-align: center;">
            <a href="{{ route('udash') }}" class="home-button">Go to Home</a>
        </div>
    </div>

    <script>
        // Optional: Add some basic JavaScript for row highlighting on hover
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', () => {
                    row.style.backgroundColor = '#f0f8ff'; // Light blue on hover
                });
                row.addEventListener('mouseleave', () => {
                    row.style.backgroundColor = ''; // Revert to default
                });
            });
        });
    </script>
</body>
</html>