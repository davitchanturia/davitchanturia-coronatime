<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Coronatime</title>
    @livewireStyles
</head>
<body>
    <header>
        <nav class="border-b border-gray-100">
            <div class="w-full md:w-336 px-4 mx-auto">
                <div class="w-full flex-col md:flex-row py-4">
                    <div class="flex items-center justify-between flex-col md:flex-row">
                        <a href="#">
                            <img src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                
                        <div class="flex items-center mt-2 md:mt-0">
                            <ul class="flex text-sm text-headText">
                                <li>
                                    <button class="flex justify-center items-center">
                                        English
                                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </li>
                                <li class="ml-4">
                                    <div class="flex">
                                        <div class="border-r-2 border-gray-100 px-3 font-bold">
                                            User
                                        </div>
                                        <div class="px-3">
                                            Log Out
                                        </div>
                                    </div>
                                  
                                </li>
                            </ul>
                        </div>
                            
                    </div>
                </div>
        
            </div>
        </nav>
      
    </header>


    {{ $slot }}
    
    @livewireScripts
</body>
</html>