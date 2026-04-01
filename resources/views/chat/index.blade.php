<!DOCTYPE html>
<html>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot>

    <style>
        .message-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            display: flex;
            gap: 10px;
            align-items: flex-end;
            max-width: 70%;
        }

        .message-text {
            padding: 10px;
            border-radius: 10px;
        }

        .self {
            justify-content: flex-end;
        }

        .self .message-text {
            background-color: #c7deff;
        }

        .other .message-text {
            background-color: #f0f0f0;
        }

        .timestamp {
            font-size: 10px;
        }
    </style>

    <body class="w-4/5 md:w-3/5 lg:w-2/5 m-auto">
        <div class="my-4 p-4 rounded-lg bg-blue-200">
            <ul class="message-container">
                @foreach ($chats as $chat)
                    <li class="{{ $chat->user_name === 'Haruki' ? 'self' : 'other' }} message">
                        <p class="timestamp">{{ $chat->created_at }} ＠{{ $chat->user_name }}</p>
                        <div class="message-text">
                            {{ $chat->message }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <form class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow" action="/chat" method="POST">
            @csrf
            <input type="hidden" name="user_identifier" value="test">
            <input class="py-1 px-2 rounded text-center flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20">
            <input class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded flex-auto" type="text" name="message" placeholder="Input message." maxlength="200">
            <button class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded text-center bg-gray-500 text-white" type="submit">Send</button>
        </form>
    </body>
</html>
