<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $otherParticipant->name ?? 'User' }}</title>
    @include('header.pheader') {{-- Your provider header --}}
    @include('sidebar.providersidebar.ssidebar')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f6f8;
            color: #333;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 280px;
            padding: 40px;
            margin-top: 80px;
            box-sizing: border-box;
        }

        .chat-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            display: flex;
            flex-direction: column;
            height: 700px;
            overflow: hidden;
        }

        .chat-header {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h2 {
            font-size: 2.6rem;
            color: #37474f;
            margin: 0;
            font-weight: 700;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #90a4ae;
            border-radius: 8px;
            background-color: #f5f5f5;
            color: #546e7a;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .back-button i {
            margin-right: 8px;
        }

        .back-button:hover {
            background-color: #e0e0e0;
            color: #37474f;
        }

        .chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            padding-bottom: 60px;
        }

        .message-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .message-container.sent {
            align-items: flex-end;
        }

        .message {
            padding: 15px 20px;
            border-radius: 15px;
            max-width: 80%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .message.sent {
            background-color: #e1f5fe;
            color: #1976d2;
            border-bottom-right-radius: 0;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.08);
        }

        .message.received {
            background-color: #f0f4c3;
            color: #689f38;
            border-top-left-radius: 0;
            box-shadow: -1px 1px 3px rgba(0, 0, 0, 0.08);
        }

        .message::before {
            content: '';
            position: absolute;
            border-width: 8px;
            border-style: solid;
            bottom: 0;
        }

        .message.sent::before {
            right: -8px;
            border-color: transparent transparent #e1f5fe #e1f5fe;
            border-bottom-right-radius: 5px;
        }

        .message.received::before {
            left: -8px;
            border-color: transparent #f0f4c3 #f0f4c3 transparent;
            border-top-left-radius: 5px;
        }

        .message .sender {
            font-size: 0.9rem;
            color: #78909c;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .message small.text-muted {
            display: block;
            font-size: 0.7rem;
            margin-top: 5px;
            color: #90a4ae;
        }

        .chat-input-area {
            border-top: 1px solid #e0e0e0;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .chat-input-wrapper {
            flex-grow: 1;
            border: 1px solid #b0bec5;
            border-radius: 25px;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-left: 15px;
            padding-right: 5px;
            margin-right: 15px;
            background-color: #fff;
        }

        .chat-input {
            flex-grow: 1;
            padding: 12px 15px;
            border: none;
            font-size: 1rem;
            line-height: 1.5;
            box-shadow: none;
            outline: none;
        }

        .send-button {
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            background-color: #1976d2;
            color: white;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
        }

        .send-button i {
            margin-left: 8px;
        }

        .send-button:hover {
            background-color: #1565c0;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }

        .message-status {
            font-size: 0.7rem;
            color: #90a4ae;
            margin-left: 5px;
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background-color: #eceff1;
            border-radius: 3px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background-color: #b0bec5;
            border-radius: 3px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background-color: #90a4ae;
        }
    </style>
</head>
<body>
    @include('sidebar.providersidebar.ssidebar')
    <div class="main-content">
        <div class="chat-container">
            <div class="chat-header">
                <h2>Chat with {{ $otherParticipant->name ?? 'User' }}</h2>
                <a href="{{ route('provider.requests.index') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back to Requests</a>
            </div>
            <div class="chat-messages">
                @foreach ($messages as $message)
                    <div class="message-container {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                        <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                            <div class="sender">
                                {{ $message->sender_id === Auth::id() ? 'You' : $message->sender->name }} ({{ $message->sender_type }})
                            </div>
                            {{ $message->message }}
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="chat-input-area">
                <form action="{{ route('chat.send', $serviceRequest->id) }}" method="POST" class="w-100">
                    @csrf
                    <div class="chat-input-wrapper">
                        <input type="text" name="message" class="chat-input" placeholder="Type your message...">
                        <button type="submit" class="send-button">Send <i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const chatMessages = document.querySelector('.chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</body>
</html>