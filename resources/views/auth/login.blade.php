<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>I Found - Register</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="140" zoomAndPan="magnify" viewBox="0 0 104.88 44.999999" height="60" preserveAspectRatio="xMidYMid meet" version="1.2"><defs><clipPath id="48cf35696b"><path d="M 20.804688 9.464844 L 47 9.464844 L 47 35.683594 L 20.804688 35.683594 Z M 20.804688 9.464844 "/></clipPath><clipPath id="5d386d0d9d"><path d="M 46.875 26.453125 L 84.332031 26.453125 L 84.332031 28 L 46.875 28 Z M 46.875 26.453125 "/></clipPath><clipPath id="164e17c24b"><path d="M 46.875 27 L 84.332031 27 L 84.332031 28.699219 L 46.875 28.699219 Z M 46.875 27 "/></clipPath><clipPath id="d35ca96f99"><path d="M 29.792969 18.210938 L 32.875 18.210938 L 32.875 21.292969 L 29.792969 21.292969 Z M 29.792969 18.210938 "/></clipPath><clipPath id="326c3d67e5"><path d="M 31.335938 18.210938 C 30.484375 18.210938 29.792969 18.898438 29.792969 19.75 C 29.792969 20.601562 30.484375 21.292969 31.335938 21.292969 C 32.1875 21.292969 32.875 20.601562 32.875 19.75 C 32.875 18.898438 32.1875 18.210938 31.335938 18.210938 Z M 31.335938 18.210938 "/></clipPath></defs><g id="daaaf7087c"><g clip-rule="nonzero" clip-path="url(#48cf35696b)"><path style=" stroke:none;fill-rule:evenodd;fill:#b62329;fill-opacity:1;" d="M 37.558594 28.527344 L 43.945312 34.910156 C 44.578125 35.542969 45.605469 35.542969 46.234375 34.910156 C 46.867188 34.277344 46.867188 33.25 46.234375 32.617188 L 39.855469 26.238281 C 41.136719 24.492188 41.898438 22.339844 41.898438 20.007812 C 41.898438 14.1875 37.175781 9.464844 31.355469 9.464844 C 25.539062 9.464844 20.816406 14.1875 20.816406 20.007812 C 20.816406 25.824219 25.539062 30.546875 31.355469 30.546875 C 33.675781 30.546875 35.820312 29.796875 37.558594 28.527344 Z M 31.355469 12.703125 C 35.386719 12.703125 38.65625 15.976562 38.65625 20.007812 C 38.65625 24.035156 35.386719 27.308594 31.355469 27.308594 C 27.328125 27.308594 24.054688 24.035156 24.054688 20.007812 C 24.054688 15.976562 27.328125 12.703125 31.355469 12.703125 Z M 31.355469 12.703125 "/></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(46.886823, 24.245663)"><path style="stroke:none" d="M 1.25 0 L 1.25 -5.765625 L 0.234375 -5.765625 L 0.234375 -7.1875 L 1.25 -7.1875 C 1.175781 -7.5 1.140625 -7.785156 1.140625 -8.046875 C 1.140625 -8.503906 1.242188 -8.894531 1.453125 -9.21875 C 1.660156 -9.539062 1.957031 -9.785156 2.34375 -9.953125 C 2.738281 -10.117188 3.207031 -10.203125 3.75 -10.203125 C 4.539062 -10.203125 5.132812 -10.066406 5.53125 -9.796875 L 5.109375 -8.46875 L 4.96875 -8.4375 C 4.695312 -8.632812 4.351562 -8.734375 3.9375 -8.734375 C 3.613281 -8.734375 3.367188 -8.648438 3.203125 -8.484375 C 3.035156 -8.328125 2.953125 -8.113281 2.953125 -7.84375 C 2.953125 -7.726562 2.957031 -7.617188 2.96875 -7.515625 C 2.988281 -7.421875 3.019531 -7.3125 3.0625 -7.1875 L 5.109375 -7.1875 L 5.109375 -5.765625 L 3.0625 -5.765625 L 3.0625 0 Z M 1.25 0 "/></g></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(52.073302, 24.245663)"><path style="stroke:none" d="M 1.9375 -8.046875 C 1.613281 -8.046875 1.347656 -8.144531 1.140625 -8.34375 C 0.929688 -8.539062 0.828125 -8.796875 0.828125 -9.109375 C 0.828125 -9.421875 0.929688 -9.675781 1.140625 -9.875 C 1.347656 -10.070312 1.613281 -10.171875 1.9375 -10.171875 C 2.15625 -10.171875 2.347656 -10.125 2.515625 -10.03125 C 2.679688 -9.9375 2.8125 -9.8125 2.90625 -9.65625 C 3 -9.5 3.046875 -9.316406 3.046875 -9.109375 C 3.046875 -8.898438 3 -8.710938 2.90625 -8.546875 C 2.8125 -8.390625 2.679688 -8.265625 2.515625 -8.171875 C 2.347656 -8.085938 2.15625 -8.046875 1.9375 -8.046875 Z M 1.03125 0 L 1.03125 -7.1875 L 2.84375 -7.1875 L 2.84375 0 Z M 1.03125 0 "/></g></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(55.943614, 24.245663)"><path style="stroke:none" d="M 1.03125 0 L 1.03125 -7.1875 L 2.765625 -7.1875 L 2.765625 -6.125 L 2.90625 -6.09375 C 3.351562 -6.914062 4.078125 -7.328125 5.078125 -7.328125 C 5.910156 -7.328125 6.519531 -7.097656 6.90625 -6.640625 C 7.300781 -6.191406 7.5 -5.535156 7.5 -4.671875 L 7.5 0 L 5.6875 0 L 5.6875 -4.453125 C 5.6875 -4.929688 5.585938 -5.273438 5.390625 -5.484375 C 5.203125 -5.691406 4.898438 -5.796875 4.484375 -5.796875 C 3.960938 -5.796875 3.554688 -5.628906 3.265625 -5.296875 C 2.984375 -4.960938 2.84375 -4.4375 2.84375 -3.71875 L 2.84375 0 Z M 1.03125 0 "/></g></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(64.361869, 24.245663)"><path style="stroke:none" d="M 3.546875 0.140625 C 2.984375 0.140625 2.484375 0.00390625 2.046875 -0.265625 C 1.609375 -0.546875 1.265625 -0.960938 1.015625 -1.515625 C 0.765625 -2.078125 0.640625 -2.769531 0.640625 -3.59375 C 0.640625 -4.414062 0.765625 -5.101562 1.015625 -5.65625 C 1.273438 -6.21875 1.628906 -6.632812 2.078125 -6.90625 C 2.523438 -7.1875 3.046875 -7.328125 3.640625 -7.328125 C 4.085938 -7.328125 4.472656 -7.25 4.796875 -7.09375 C 5.128906 -6.9375 5.410156 -6.695312 5.640625 -6.375 L 5.765625 -6.40625 L 5.765625 -10.078125 L 7.578125 -10.078125 L 7.578125 0 L 5.765625 0 L 5.765625 -0.9375 L 5.640625 -0.953125 C 5.441406 -0.617188 5.164062 -0.351562 4.8125 -0.15625 C 4.46875 0.0390625 4.046875 0.140625 3.546875 0.140625 Z M 4.140625 -1.390625 C 4.648438 -1.390625 5.050781 -1.570312 5.34375 -1.9375 C 5.632812 -2.300781 5.78125 -2.851562 5.78125 -3.59375 C 5.78125 -4.332031 5.632812 -4.882812 5.34375 -5.25 C 5.050781 -5.613281 4.648438 -5.796875 4.140625 -5.796875 C 3.609375 -5.796875 3.203125 -5.617188 2.921875 -5.265625 C 2.640625 -4.910156 2.5 -4.351562 2.5 -3.59375 C 2.5 -2.832031 2.640625 -2.273438 2.921875 -1.921875 C 3.203125 -1.566406 3.609375 -1.390625 4.140625 -1.390625 Z M 4.140625 -1.390625 "/></g></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(72.975594, 24.245663)"><path style="stroke:none" d="M 1.03125 0 L 1.03125 -7.1875 L 2.78125 -7.1875 L 2.78125 -6.125 L 2.921875 -6.09375 C 3.097656 -6.488281 3.328125 -6.78125 3.609375 -6.96875 C 3.890625 -7.15625 4.234375 -7.25 4.640625 -7.25 C 5.046875 -7.25 5.359375 -7.179688 5.578125 -7.046875 L 5.265625 -5.484375 L 5.125 -5.453125 C 5.007812 -5.503906 4.894531 -5.539062 4.78125 -5.5625 C 4.675781 -5.582031 4.546875 -5.59375 4.390625 -5.59375 C 3.890625 -5.59375 3.503906 -5.414062 3.234375 -5.0625 C 2.972656 -4.707031 2.84375 -4.140625 2.84375 -3.359375 L 2.84375 0 Z M 1.03125 0 "/></g></g><g style="fill:#54555a;fill-opacity:1;"><g transform="translate(77.288412, 24.245663)"><path style="stroke:none" d="M 1.84375 0.0625 C 1.601562 0.0625 1.394531 0.015625 1.21875 -0.078125 C 1.050781 -0.171875 0.921875 -0.300781 0.828125 -0.46875 C 0.734375 -0.632812 0.6875 -0.820312 0.6875 -1.03125 C 0.6875 -1.238281 0.734375 -1.425781 0.828125 -1.59375 C 0.921875 -1.757812 1.050781 -1.890625 1.21875 -1.984375 C 1.394531 -2.078125 1.601562 -2.125 1.84375 -2.125 C 2.070312 -2.125 2.273438 -2.078125 2.453125 -1.984375 C 2.628906 -1.890625 2.765625 -1.757812 2.859375 -1.59375 C 2.953125 -1.425781 3 -1.238281 3 -1.03125 C 3 -0.71875 2.890625 -0.457031 2.671875 -0.25 C 2.460938 -0.0390625 2.1875 0.0625 1.84375 0.0625 Z M 1.84375 0.0625 "/></g></g><g clip-rule="nonzero" clip-path="url(#5d386d0d9d)"><path style=" stroke:none;fill-rule:nonzero;fill:#ffffff;fill-opacity:1;" d="M 46.910156 26.453125 L 84.039062 26.453125 L 84.039062 27.398438 L 46.910156 27.398438 Z M 46.910156 26.453125 "/></g><g clip-rule="nonzero" clip-path="url(#164e17c24b)"><path style=" stroke:none;fill-rule:nonzero;fill:#b62329;fill-opacity:1;" d="M 46.910156 27.398438 L 84.039062 27.398438 L 84.039062 28.347656 L 46.910156 28.347656 Z M 46.910156 27.398438 "/></g><g clip-rule="nonzero" clip-path="url(#d35ca96f99)"><g clip-rule="nonzero" clip-path="url(#326c3d67e5)"><path style=" stroke:none;fill-rule:nonzero;fill:#ed1e28;fill-opacity:1;" d="M 29.792969 18.210938 L 32.875 18.210938 L 32.875 21.292969 L 29.792969 21.292969 Z M 29.792969 18.210938 "/></g></g></g></svg>
            </a>
        </header>

        <!-- Main Container -->
        <div class="flex justify-center items-center min-h-[calc(100vh-68px)] p-6 lg:p-10">
            <div class="flex flex-col lg:flex-row gap-8 items-center justify-center max-w-6xl w-full">

                <!-- Registration Form -->
                <div class="w-full max-w-[400px] min-h-[440px] bg-white border border-[#A4A4A4] rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] p-8 flex flex-col">
                    <h2 class="text-2xl font-semibold text-slate-800 mb-8 text-left">Login</h2>

                    <form action="{{ route('login') }}" method="POST" class="flex flex-col flex-grow space-y-5">
                        @csrf
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
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
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
                        <h1 class="text-2xl lg:text-3xl font-bold mb-4 leading-tight">Welcome to findr.</h1>
                        <p>A Centralized Lost and Found Website</p>
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
