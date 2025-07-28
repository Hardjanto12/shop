@extends('layouts.app')

@section('title', 'Home')
@section('styles')
    <style>
        /* Typing effect  */
        h2 {
            font-size: 5em;
            color: white;
            text-transform: uppercase;
        }

        span {
            border-right: .05em solid;
            animation: caret 1s steps(1) infinite;
        }

        @keyframes caret {
            50% {
                border-color: transparent;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mt-12">
        <div class="flex flex-row text-center">
            <div class="basis-2/3 mx-auto px-20 py-10">
                <img class="h-full w-full object-contain object-right mx-auto drop-shadow-lg sm:rounded-3xl"
                    src="/img/jakafull.jpg">
            </div>
            <div class="basis-1/3 px-16 py-10 flex flex-col justify-center">
                <div class="flex flex-col items-center my-4">
                    <h1 class="text-7xl font-regular uppercase text-center text-white">Welcome To
                        WinnnStore
                    </h1>
                </div>
                <div class="flex flex-col items-center my-4">
                    <p class="clear-none text-center font-medium text-white z-20">
                        Selamat datang, gamer! Situs kami adalah gerbang ke petualangan dan hiburan tanpa batas. Temukan
                        game terbaru, top-up, promosi, atau dukungan di menu atas.
                        Baru di sini? Segera top-up dan kembali di dunia kompetitif!
                    </p>
                </div>
                <div class="flex justify-center my-4">
                    <a class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-600 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-blue-800"
                        href="{{ route('mobile-legends') }}">Boost Your Power – Top Up Now!</a>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#b83404" fill-opacity="1"
                d="M0,128L30,144C60,160,120,192,180,208C240,224,300,224,360,186.7C420,149,480,75,540,80C600,85,660,171,720,181.3C780,192,840,128,900,122.7C960,117,1020,171,1080,202.7C1140,235,1200,245,1260,240C1320,235,1380,213,1410,202.7L1440,192L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
            </path>
        </svg>
        <div class="flex flex-row bg-[#b83404] -mt-2 ">
            <div class="basis-1/3 mx-auto px-20 py-10  text-white">
                <img class="w-auto h-full" src="img/cyper.png" alt="">
            </div>
            <div class="basis-1/3 mx-auto text-center flex flex-col justify-center">
                <p class="text-5xl font-regular text-white my-4">MASIH BINGUNG CARA TOP UP NYA?</p>
                <p class="my-2 text-white">Kunjungi halaman berikut untuk tutorial cara melakukan topup di Winnnstore</p>
                <div class="flex justify-center my-4">
                    <a class="text-white bg-[#191E29] hover:bg-[#242e44] focus:ring-4 focus:ring-orange-600 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none dark:focus:ring-blue-800 "
                        href="{{ route('mobile-legends') }}">Learn More</a>
                </div>
            </div>
            <div class="basis-1/3 mx-auto px-20 py-10  text-white">
                <img class="w-auto h-full" src="img/sage.png" alt="">
            </div>
        </div>


        <svg class="bg-[#b83404]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#b83404" fill-opacity="1"
                d="M0,224L18.5,218.7C36.9,213,74,203,111,186.7C147.7,171,185,149,222,170.7C258.5,192,295,256,332,266.7C369.2,277,406,235,443,218.7C480,203,517,213,554,192C590.8,171,628,117,665,122.7C701.5,128,738,192,775,181.3C812.3,171,849,85,886,90.7C923.1,96,960,192,997,213.3C1033.8,235,1071,181,1108,138.7C1144.6,96,1182,64,1218,74.7C1255.4,85,1292,139,1329,149.3C1366.2,160,1403,128,1422,112L1440,96L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z">
            </path>
        </svg>
        <div class="flex flex-row bg-[#b83404] -mt-2 ">
            <div class="basis-1/3 mx-auto px-20 py-10  flex flex-col justify-center text-center  text-white">
                <p class="text-5xl font-regular my-4">MASIH BINGUNG CARA TOP UP NYA?</p>
                <p class="my-2">Kunjungi halaman berikut untuk tutorial cara melakukan topup di Winnnstore</p>
                <div class="flex justify-center my-4">
                    <a class="text-white bg-[#191E29] hover:bg-[#1a2131] focus:ring-4 focus:ring-orange-600 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none dark:focus:ring-blue-800"
                        href="{{ route('mobile-legends') }}">Learn More</a>
                </div>
            </div>
            <div class="basis-2/3 mx-auto pl-40">
                <img class="w-auto h-full" src="img/omen.png" alt="">
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            // array with texts to type in typewriter
            var dataText = ["Welcome To WinnnStore", "Top Up Mobile Legends", "Top Up Valorant",
                "Welcome To WinnnStore"
            ];

            // type one text in the typwriter
            // keeps calling itself until the text is finished
            function typeWriter(text, i, fnCallback) {
                // chekc if text isn't finished yet
                if (i < (text.length)) {
                    // add next character to h1
                    document.querySelector("h2").innerHTML = text.substring(0, i + 1) +
                        '<span aria-hidden="true"></span>';

                    // wait for a while and call this function again for next character
                    setTimeout(function() {
                        typeWriter(text, i + 1, fnCallback)
                    }, 100);
                }
                // text finished, call callback if there is a callback function
                else if (typeof fnCallback == 'function') {
                    // call callback after timeout
                    setTimeout(fnCallback, 3000);
                }
            }
            // start a typewriter animation for a text in the dataText array
            function StartTextAnimation(i) {
                if (typeof dataText[i] == 'undefined') {
                    setTimeout(function() {
                        StartTextAnimation(0);
                    }, 20000);
                }
                // check if dataText[i] exists
                if (i < dataText[i].length) {
                    // text exists! start typewriter animation
                    typeWriter(dataText[i], 0, function() {
                        // after callback (and whole text has been animated), start next text
                        StartTextAnimation(i + 1);
                    });
                }
            }
            // start the text animation
            StartTextAnimation(0);
        });
    </script>
@endsection
