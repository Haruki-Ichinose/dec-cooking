<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel View</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="bg-gray-100 py-10 h-screen">
    <div class="container mx-auto">
        <form action="{{ route('participate_family') }}" method="POST" class="bg-white p-8 shadow-md w-1/2 mx-auto">
            @csrf
            <div class="mb-4">
                <label for="family_id" class="block text-gray-700 text-sm font-bold mb-2">Family id を入力してください</label>
                <input type="text" id="family_id" name="family_id" placeholder="入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">送信</button>
            </div>
        </form>
    </div>
</body>