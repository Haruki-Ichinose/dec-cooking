<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel View</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 relative h-screen">

    <!-- Log Out Button -->
    <div class="absolute bottom-6 left-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button onclick="event.preventDefault(); this.closest('form').submit();" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 transition duration-300 transform hover:-translate-y-1">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

    <div class="container mx-auto mt-4 p-4">
        <div class="grid grid-cols-3 gap-8">

            <!-- Calendar Button -->
            <div class="flex items-center justify-center">
                <a href="{{ route('calendar') }}" class="block w-64 h-32 px-6 py-3 bg-blue-600 text-white text-center rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1 flex items-center justify-center">Calendar</a>
            </div>

            <!-- Chat Button -->
            <div class="flex items-center justify-center">
                <a href="{{ route('chat.index') }}" class="block w-64 h-32 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition duration-300 transform hover:-translate-y-1 flex items-center justify-center">Chat</a>
            </div>

            <!-- Family List -->
            <div>
                @foreach($users as $user)
                <div class="flex justify-between items-center bg-white p-4 mb-4 rounded-lg shadow-md" style="font-size: 1.5em;">
                    {{ $user->name }}
                    <select class="border bg-gray-300 rounded-md text-gray-700" style="font-size: 0.6em; padding: 0.5em 1em;">
                        <option value="sleeping">就寝中</option>
                        <option value="out">外出中</option>
                        <option value="home">家</option>
                    </select>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</body>

</html>
