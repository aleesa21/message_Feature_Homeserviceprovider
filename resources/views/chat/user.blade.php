<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $otherParticipant->name ?? 'Provider' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #f0f2f5, #e1e6ed); /* Subtle gradient background */
        color: #333;
        min-height: 100vh; /* Ensure full viewport height */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .main-content {
        background-color: transparent; /* Make the main content background transparent */
        padding: 40px;
        box-sizing: border-box;
        width: 100%;
        max-width: 900px; /* Limit the width of the chat container */
    }
    .chat-container {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* More pronounced shadow */
        padding: 30px;
        display: flex;
        flex-direction: column;
        height: 700px;
        overflow: hidden;
    }
    .chat-header {
        border-bottom: 1px solid #e8e8e8;
        padding-bottom: 20px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .chat-header h2 {
        font-size: 2.4rem; /* Slightly smaller and bolder */
        color: #2c3e50; /* Darker, modern color */
        margin: 0;
        font-weight: 600;
    }
    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        padding-bottom: 20px;
    }
    .message-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 18px; /* Slightly more spacing */
        align-items: flex-start;
    }
    .message-container.sent {
        align-items: flex-end;
    }
    .message {
        padding: 15px 20px;
        border-radius: 20px; /* More rounded corners */
        max-width: 80%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); /* Subtle message shadow */
        position: relative;
        font-size: 1rem;
        line-height: 1.5;
    }
    .message.sent {
        background-color: #5dade2; /* Softer blue */
        color: black;
        border-bottom-right-radius: 5px;
    }
    .message.received {
        background-color: #ecf0f1; /* Light grey */
        color: #333;
        border-top-left-radius: 5px;
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
        border-color: transparent transparent #5dade2 #5dade2;
        border-bottom-right-radius: 8px;
    }
    .message.received::before {
        left: -8px;
        border-color: transparent #ecf0f1 #ecf0f1 transparent;
        border-top-left-radius: 8px;
    }
    .message .sender {
        font-size: 0.9rem; /* Slightly increased size */
        color: #fff; /* White color for "You" in sent messages */
        margin-bottom: 5px;
        font-weight: 600; /* Slightly bolder */
    }
    .message.received .sender {
        color: #7f8c8d; /* Keep the muted grey for received messages */
    }
    .message small.text-muted {
        display: block;
        font-size: 0.8rem; /* Slightly increased size */
        margin-top: 5px;
        color: #f0f8ff; /* Very light almost white for better contrast on blue */
    }
    .message.received small.text-muted {
        color: #95a5a6; /* Keep the muted grey for received messages */
    }
    .chat-input-area {
        border-top: 1px solid #e8e8e8;
        padding: 15px 20px;
        display: flex;
        align-items: center;
    }
    .chat-input-wrapper {
        flex-grow: 1;
        border: 1px solid #bdc3c7;
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
        color: #333;
    }
    .send-button {
        padding: 12px 20px;
        border: none;
        border-radius: 25px;
        background-color:rgb(18, 144, 228); /* Softer blue for send button too */
        color: white;
        cursor: pointer;
        font-size: 1.1rem;
        font-weight: 500;
        transition: background-color 0.2s ease-in-out, transform 0.1s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }
    .send-button i {
        margin-left: 8px;
    }
    .send-button:hover {
        background-color: #2e86c1; /* Darker shade on hover */
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    .message-status {
        font-size: 0.75rem;
        color: #7f8c8d;
        margin-left: 5px;
    }
    .chat-messages::-webkit-scrollbar {
        width: 8px;
    }
    .chat-messages::-webkit-scrollbar-track {
        background-color: #f0f0f0;
        border-radius: 4px;
    }
    .chat-messages::-webkit-scrollbar-thumb {
        background-color: #bdc3c7;
        border-radius: 4px;
    }
    .chat-messages::-webkit-scrollbar-thumb:hover {
        background-color: #95a5a6;
    }
    .bottom-actions {
        display: flex;
        justify-content: flex-end;
        padding: 15px 30px;
        background-color: #f9f9f9;
        border-top: 1px solid #e8e8e8;
        border-radius: 0 0 15px 15px;
    }
    .bottom-actions .back-button {
        display: inline-flex;
        align-items: center;
        padding: 10px 18px; /* Slightly more horizontal padding */
        border: 1px solid #bdc3c7;
        border-radius: 8px;
        background-color: #fff; /* White background */
        color: #7f8c8d;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.1s ease-in-out;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    .bottom-actions .back-button i {
        margin-right: 8px;
        color: #7f8c8d;
    }
    .bottom-actions .back-button:hover {
        background-color: #ecf0f1; /* Light grey on hover */
        color: #2c3e50;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
</head>

<body>
    <div class="main-content">
        <div class="chat-container">
            <div class="chat-header">
                <h2>Chat with {{ $otherParticipant->name ?? 'Provider' }}</h2>
            </div>
            <div class="chat-messages">
                @foreach ($messages as $message)
                <div class="message-container {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                    <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                        <div class="sender">
                            {{ $message->sender_id === Auth::id() ? 'You' : $message->sender->name }}
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
            <div class="bottom-actions">
                <a href="{{ route('user.messages') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back to Messages</a>
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