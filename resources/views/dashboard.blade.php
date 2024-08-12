@props(['signin' => ''])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #timer {
            font-size: 200px;
        }

        .modal-bg {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body
    class="flex flex-col items-center justify-between h-screen p-4 {{ $signin == '1' ? 'bg-gray-300' : 'bg-gray-400' }}">

    <!-- Settings -->
    <div class="w-full flex justify-end p-4 gap-x-4">
        @if ($signin == '0')
            <a href="{{ route('auth.socialite.redirect', 'google') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-google fa-2x"></i>
            </a>
            <a href="{{ route('auth.socialite.redirect', 'twitter') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
        @endif
        <button id="settingsButton" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-cog fa-2x"></i>
        </button>
    </div>

    <!-- Timer display -->
    <div class="flex-grow flex items-center justify-center">
        <span id="timer" class="font-bold">00:00</span>
    </div>

    <!-- Start/Pause and Reset buttons -->
    <div class="w-full flex justify-center space-x-4 p-4">
        <button id="startPauseButton" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Start</button>
        <button id="resetButton" class="px-4 py-2 bg-red-600 text-white rounded-lg">Reset</button>
    </div>

    <!-- Settings Modal -->
    <div id="settingsModal" class="fixed inset-0 flex items-center justify-center modal-bg hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold mb-1">Settings</h2>
                @if ($signin != '1')
                    <p class="text-red-400">Signin to experience full features</p>
                @endif
            </div>


            <div>
                <label class="block mb-2">
                    Timer Mode:
                </label>
                <select id="timerMode" class="block border rounded p-2 w-full mb-4">
                    <option value="predefined">Predefined</option>
                    <option value="custom" @if ($signin != '1') disabled @endif>Custom</option>
                </select>
            </div>

            <div id="predefinedTimers" class="mb-4">
                <label class="block mb-2">
                    Predefined Timers:
                </label>
                <select id="predefinedTimerSelect" class="block border rounded p-2 w-full">
                    <option value="300">5 minutes</option>
                    <option value="600">10 minutes</option>
                    <option value="900">15 minutes</option>
                    <option value="1800">30 minutes</option>
                    <option value="2700">45 minutes</option>
                    <option value="3600">60 minutes</option>
                    <option value="5400">90 minutes</option>
                </select>
            </div>

            <div id="customTimer" class="mb-4">
                <label class="block mb-2">
                    Duration (seconds):
                </label>
                <input type="number"
                    id="customDuration"
                    class="block border rounded p-2 w-full"
                    min="1"
                    value="300"
                    @if ($signin != '1') 
                        disabled
                    @endif
                    >
            </div>

            <div>
                <label class="block mb-2">
                    Orange Alert (seconds remaining):
                </label>
                <input type="number"
                    id="orangeAlert"
                    class="block border rounded p-2 w-full mb-4"
                    min="0"
                    value="60"
                    @if ($signin != '1') disabled @endif>
            </div>

            <div>
                <label class="block mb-2">
                    Red Alert (seconds remaining):
                </label>
                <input type="number"
                    id="redAlert"
                    class="block border rounded p-2 w-full mb-4"
                    min="0"
                    value="30"
                    @if ($signin != '1') disabled @endif>
            </div>

            <div class="flex items-center mb-4 gap-4">
                <label class="block">
                    Stop at 00:00:
                </label>
                <input type="checkbox" id="stopAtZero" class="rounded" checked>
            </div>

            <div class="flex justify-end">
                <button id="saveSettingsButton" class="px-4 py-2 bg-green-600 text-white rounded-lg">Save</button>
                <button id="closeSettingsButton" class="px-4 py-2 bg-gray-600 text-white rounded-lg ml-2">Close</button>
            </div>
        </div>
    </div>

    <script>
        window.APP_SIGNIN = @json($signin);
    </script>

    <!-- FontAwesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Include timer functionality -->
    <script src="{{ asset('js/timer.js') }}"></script>
</body>

</html>