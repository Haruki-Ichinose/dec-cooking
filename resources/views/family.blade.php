<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel View</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<div class="flex flex-col items-center justify-center h-full">
    <!-- Familyを作る button -->
    <a href="{{ route('create_family') }}" class="mb-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
    Familyを作る
    </a>
    <!-- Familyに参加する button -->
    <a href="{{ route('participate') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
        Familyに参加する
    </a>
</div>