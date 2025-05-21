<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Inventory
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white m-0 p-0 min-h-screen flex flex-col">
    <header class="bg-[#2563EB] flex justify-between items-center px-4 py-3 ">
        <div class="flex items-center">
            <img alt="Logo with blue and orange geometric shapes" class="w-12 h-12" height="40" src="assets/logos.png"
                width="40" />
        </div>
        <nav class="flex items-center space-x-2 text-black text-base font-normal">
            <a href="{{ route('login') }}"><button class="bg-white px-4 py-2 font-normal text-black leading-none"
                    type="button">
                    log in
                </button></a>
            <span class="text-white select-none">
                /
            </span>
            <a href="{{ route('register') }}"><button class="bg-white px-4 py-2 font-normal text-black leading-none"
                    type="button">
                    sign up
                </button></a>
        </nav>
    </header>
    <main class="flex-grow flex justify-center items-center">
        <div class="flex items-center space-x-2">
            <img alt="Logo with blue and orange geometric shapes" class="w-15 h-15" height="60"
                src="assets/logos.png" width="60" />
            <h1 class="text-5xl font-normal flex flex-wrap">
                <span class="text-[#F97316]">
                    Inven
                </span>
                <span class="text-[#1E40AF]">
                    tory
                </span>
            </h1>
        </div>
    </main>
</body>

</html>
