<x-guest-layout>
    <div class="max-h-screen flex">
        <!-- Left side - Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Logo -->
                <div class="flex justify-center">
                    <a href="/" class="flex items-center">
                        <span class="text-lime-600 text-3xl font-bold">DevConnect</span>
                    </a>
                </div>
                
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 text-center">
                    Welcome back
                </h2>
                <p class="mt-2 text-sm text-gray-600 text-center">
                    Sign in to continue to your developer network
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 mt-4" :status="session('status')" />

                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" 
                                class="py-3 pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-lime-500 focus:border-lime-500" 
                                placeholder="you@example.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="current-password" 
                                class="py-3 pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-lime-500 focus:border-lime-500" 
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" 
                                class="h-4 w-4 text-lime-600 focus:ring-lime-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        {{-- @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-lime-600 hover:text-lime-500">
                                Forgot your password?
                            </a>
                        @endif --}}
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-lime-600 hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500">
                            Sign in
                        </button>
                    </div>
                </form>

                <!-- Registration Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-lime-600 hover:text-lime-500">
                            Register now
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Right side - Image and Code -->
             </div>
            </div>
        </div>
    </div>
</x-guest-layout>