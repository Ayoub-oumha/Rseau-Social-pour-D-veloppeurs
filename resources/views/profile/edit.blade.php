<!-- filepath: /c:/Users/lenovo/Desktop/Laravel project/Rseau-Social-pour-D-veloppeurs/resources/views/profile/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-lime-700 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border-t-4 border-lime-600">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-lime-700 mb-4">
                        {{ __('Profile Information') }}
                    </h2>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')" class="text-lime-700" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" class="text-lime-700" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <!-- Professional Info -->
                        <div>
                            <x-input-label for="headline" :value="__('Professional Headline')" class="text-lime-700" />
                            <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('headline', $user->headline)" placeholder="e.g. Senior Full Stack Developer" />
                            <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="work" :value="__('Current Work')" class="text-lime-700" />
                                <x-text-input id="work" name="work" type="text" class="mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('work', $user->work)" placeholder="e.g. Company Name" />
                                <x-input-error class="mt-2" :messages="$errors->get('work')" />
                            </div>

                            <div>
                                <x-input-label for="location" :value="__('Location')" class="text-lime-700" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('location', $user->location)" placeholder="e.g. San Francisco, CA" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>
                        </div>

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" :value="__('About Me')" class="text-lime-700" />
                            <textarea id="bio" name="bio" class="mt-1 block w-full rounded-md border-lime-300 focus:border-lime-600 focus:ring-lime-600" rows="4" placeholder="Tell other developers about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <!-- Links -->
                        <div class="border-t border-lime-200 pt-4">
                            <h3 class="text-md font-medium text-lime-700 mb-3">Social Links</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="github_url" :value="__('GitHub Profile')" class="text-lime-700" />
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-lime-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                            </svg>
                                        </div>
                                        <x-text-input id="github_url" name="github_url" type="url" class="pl-10 mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('github_url', $user->github_url)" placeholder="https://github.com/username" />
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
                                </div>

                                <div>
                                    <x-input-label for="website" :value="__('Personal Website')" class="text-lime-700" />
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-lime-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                            </svg>
                                        </div>
                                        <x-text-input id="website" name="website" type="text" class="pl-10 mt-1 block w-full border-lime-300 focus:border-lime-600 focus:ring-lime-600" :value="old('website', $user->website)" placeholder="https://yourwebsite.com" />
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                                </div>
                            </div>
                        </div>

                     
                       

                        <div class="flex items-center justify-end gap-4 pt-2">
                            <x-primary-button class="bg-lime-600 hover:bg-lime-700">
                                {{ __('Save Profile') }}
                            </x-primary-button>
                           

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-lime-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border-t-4 border-lime-600">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border-t-4 border-lime-600">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>