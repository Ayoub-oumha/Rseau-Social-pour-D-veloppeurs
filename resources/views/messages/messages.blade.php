<x-app-layout>
    <div class="bg-gray-50 h-screen pt-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-[calc(100vh-4rem)]">
                <!-- Left sidebar - Conversations list -->
                <div class="w-1/3 border-r border-gray-200 bg-white flex flex-col">
                    <!-- Search bar -->
                    <div class="p-4 border-b">
                        <div class="relative">
                            <input type="text" placeholder="Search messages" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="flex-1 overflow-y-auto">
                        <div class="divide-y divide-gray-200">
                            <!-- Active conversation -->
                            <div class="px-4 py-3 bg-lime-50 border-l-4 border-lime-500 flex items-center hover:bg-lime-100 cursor-pointer">
                                <div class="relative flex-shrink-0">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-12 w-12 rounded-full object-cover">
                                    <div class="absolute bottom-0 right-0 bg-green-500 h-3 w-3 rounded-full border-2 border-white"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-semibold text-gray-900">John Smith</h3>
                                        <span class="text-xs text-gray-500">10:42 AM</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">Did you check my React component? I need some feedback...</p>
                                </div>
                            </div>
                            
                            <!-- Other conversations -->
                            @foreach ($connections as $connection)
                            <div class="px-4 py-3 flex items-center hover:bg-gray-50 cursor-pointer">
                                <div class="relative flex-shrink-0">
                                    @if(!empty($connection->profile_image))
                                        <img src="{{ $connection->profile_image }}" alt="{{ $connection->name }}" class="h-12 w-12 rounded-full object-cover">
                                    @else
                                        <div class="h-12 w-12 rounded-full flex items-center justify-center bg-gray-300 text-gray-600 font-medium uppercase">
                                            @php
                                                $nameParts = explode(' ', $connection->name);
                                                $initials = substr($nameParts[0], 0, 1);
                                                if (count($nameParts) > 1) {
                                                    $initials .= substr($nameParts[1], 0, 1);
                                                } else {
                                                    $initials .= substr($nameParts[0], 1, 1);
                                                }
                                            @endphp
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-0 right-0 bg-gray-400 h-3 w-3 rounded-full border-2 border-white"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-semibold text-gray-900">{{$connection->name}}</h3>
                                        <span class="text-xs text-gray-500">Yesterday</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">{{$connection->headline}}</p>
                                </div>
                            </div>  
                            @endforeach
                           
                            
                            {{-- <div class="px-4 py-3 flex items-center hover:bg-gray-50 cursor-pointer">
                                <div class="relative flex-shrink-0">
                                    <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="User" class="h-12 w-12 rounded-full object-cover">
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-semibold text-gray-900">Alex Johnson</h3>
                                        <span class="text-xs text-gray-500">Tuesday</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">When is the next team meetup?</p>
                                </div>
                            </div> --}}
                            
                            <!-- Add more conversations as needed -->
                            <!-- Repeat the structure for more conversations -->
                            
                        </div>
                    </div>
                </div>
                
                <!-- Right side - Current conversation -->
                <div class="w-2/3 flex flex-col bg-white">
                    <!-- Chat header -->
                    <div class="px-6 py-3 border-b flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="relative">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-10 w-10 rounded-full object-cover">
                                <div class="absolute bottom-0 right-0 bg-green-500 h-2.5 w-2.5 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">John Smith</h3>
                                <p class="text-xs text-green-600">Online</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </button>
                            <button class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                            <button class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50">
                        <!-- Date separator -->
                        <div class="flex items-center justify-center">
                            <span class="px-4 py-1 bg-gray-200 rounded-full text-xs text-gray-600">Today</span>
                        </div>
                        
                        <!-- Received message -->
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-2 max-w-[80%]">
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <p class="text-sm text-gray-800">Hey there! Could you help me review this React component I've been working on? I'm facing some issues with state management.</p>
                                </div>
                                <span class="text-xs text-gray-500 mt-1 inline-block">10:30 AM</span>
                            </div>
                        </div>
                        
                        <!-- Received message with code -->
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-2 max-w-[80%]">
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <p class="text-sm text-gray-800 mb-2">Here's the code:</p>
                                    <pre class="bg-gray-900 text-gray-100 p-3 rounded text-xs font-mono overflow-x-auto"><code>import React, { useState } from 'react';

function Counter() {
  const [count, setCount] = useState(0);
  
  return (
    &lt;div&gt;
      &lt;p&gt;Count: {count}&lt;/p&gt;
      &lt;button onClick={() => setCount(count + 1)}&gt;
        Increment
      &lt;/button&gt;
    &lt;/div&gt;
  );
}</code></pre>
                                </div>
                                <span class="text-xs text-gray-500 mt-1 inline-block">10:32 AM</span>
                            </div>
                        </div>
                        
                        <!-- Sent message -->
                        <div class="flex justify-end">
                            <div class="max-w-[80%]">
                                <div class="bg-lime-500 text-white rounded-lg p-3 shadow-sm">
                                    <p class="text-sm">The code looks good! What specific issue are you having with state management?</p>
                                </div>
                                <div class="flex justify-end">
                                    <span class="text-xs text-gray-500 mt-1 inline-block">10:35 AM</span>
                                    <svg class="h-4 w-4 text-gray-500 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Received message -->
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-2 max-w-[80%]">
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <p class="text-sm text-gray-800">When I click the increment button multiple times quickly, it doesn't always update correctly. I think I need to use useEffect or useCallback, but I'm not sure how...</p>
                                </div>
                                <span class="text-xs text-gray-500 mt-1 inline-block">10:42 AM</span>
                            </div>
                        </div>
                        
                        <!-- Typing indicator -->
                        <div class="flex items-start">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-2 flex space-x-1 items-center">
                                <div class="bg-gray-300 w-2 h-2 rounded-full animate-bounce"></div>
                                <div class="bg-gray-300 w-2 h-2 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                <div class="bg-gray-300 w-2 h-2 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message input -->
                    <div class="p-4 border-t">
                        <form class="flex items-center space-x-2">
                            <button type="button" class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <button type="button" class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <button type="button" class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Type a message..." class="flex-1 border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500">
                            <button type="submit" class="p-2 bg-lime-600 text-white rounded-full hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Add any JavaScript functionality you need here
        // For example, auto-scrolling to bottom of messages, handling message submission, etc.
    </script>
</x-app-layout>