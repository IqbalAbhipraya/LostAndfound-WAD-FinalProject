<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>I Found - Register</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans min-h-screen bg-gradient-to-r from-[#E9E9FF] to-[#EDFFBB] text-slate-800">
        <!-- Header -->
        <header class="flex w-full h-[68px] px-6 py-3 items-center justify-between border-b border-[#A4A4A4] bg-white/50 backdrop-blur-[2px] sticky top-0 z-30">
            <a href="/" class="flex items-center text-xl font-bold text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                I FOUND
            </a>
        </header>

        <!-- Main Container -->
        <div class="flex justify-center items-center min-h-[calc(100vh-68px)] p-6 lg:p-10">
            <div class="flex flex-col lg:flex-row gap-8 items-center max-w-6xl w-full">

                <!-- Registration Form -->
                <div class="w-full max-w-[400px] min-h-[440px] bg-white border border-[#A4A4A4] rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] p-8 flex flex-col">
                    <h2 class="text-2xl font-semibold text-slate-800 mb-8 text-left">Login</h2>

                    <form action="#" method="POST" class="flex flex-col flex-grow space-y-5">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="w-full px-4 py-3 border border-slate-300 rounded-md bg-slate-100 text-slate-900 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                required
                            >
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                            <div class="relative">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="w-full px-4 py-3 pr-12 border border-slate-300 rounded-md bg-slate-100 text-slate-900 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    required
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    aria-label="Toggle password visibility"
                                >
                                    <svg id="eye-icon-password" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eye-slash-icon-password" class="h-5 w-5 text-slate-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.052 10.052 0 013.646-4.85M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.354-4.354l-14.708 14.708" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        <!-- Submit Button and Login Link -->
                        <div class="mt-auto pt-5">
                            <button
                                type="submit"
                                class="w-full bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-3 px-4 rounded-md shadow-sm transition duration-150 ease-in-out"
                            >
                                Login
                            </button>
                            <p class="text-xs text-center text-slate-600 mt-4">
                                Dont have an account?
                                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">Sign up</a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Welcome Section -->
                <div class="w-full max-w-[550px] h-[440px] rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] relative overflow-hidden flex items-center sm:hidden lg:flex">
                    <img
                        src="welcome_photo.png"
                        alt="Welcome background"
                        class="absolute inset-0 w-full h-full object-cover -z-10"
                    >
                    <div class="absolute inset-0 bg-black/60"></div>
                    <div class="relative z-10 text-white p-8 lg:p-12">
                        <h1 class="text-2xl lg:text-3xl font-bold mb-4 leading-tight">Welcome to Our Lost and Found Website!</h1>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function togglePassword(fieldId) {
                const passwordField = document.getElementById(fieldId);
                const eyeIcon = document.getElementById('eye-icon-' + fieldId);
                const eyeSlashIcon = document.getElementById('eye-slash-icon-' + fieldId);

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                } else {
                    passwordField.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                }
            }
        </script>
    </body>
</html>
