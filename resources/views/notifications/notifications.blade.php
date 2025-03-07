<x-app-layout>
    <div class="bg-gray-50 min-h-screen pt-16 pb-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
                <p class="text-sm text-gray-600">Stay updated with activity related to your profile and content</p>
            </div>
            
            <!-- Filter tabs -->
            {{-- <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <button class="px-1 py-4 text-sm font-medium text-lime-700 border-b-2 border-lime-500">
                        All
                    </button>
                    <button class="px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                        Unread <span class="ml-2 bg-lime-100 text-lime-600 py-0.5 px-2 rounded-full text-xs">12</span>
                    </button>
                    <button class="px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                        Mentions
                    </button>
                </nav>
            </div> --}}
            
            <!-- Controls -->
            <div class="flex justify-between items-center mb-4">
                <button class="text-sm text-lime-600 hover:text-lime-800 font-medium">
                    Mark all as read
                </button>
                {{-- <div class="flex items-center">
                    <span class="text-sm text-gray-500 mr-2">Filter by:</span>
                    <select class="text-sm border-gray-300 rounded-md focus:border-lime-500 focus:ring-lime-500">
                        <option>All types</option>
                        <option>Connections</option>
                        <option>Comments</option>
                        <option>Likes</option>
                        <option>Mentions</option>
                    </select>
                </div> --}}
            </div>
            
            <!-- Notifications List -->
            <div class="bg-white shadow rounded-lg divide-y divide-gray-200">
                <!-- Unread Connection Request -->
                {{-- <div class="p-4 flex items-start space-x-4 bg-lime-50">
                    <div class="relative flex-shrink-0">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="h-12 w-12 rounded-full">
                        <div class="absolute top-0 right-0 h-3 w-3 bg-lime-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-900">
                                <span class="font-semibold">Emma Wilson</span> sent you a connection request
                            </p>
                            <div class="flex items-center">
                                <span class="text-xs text-gray-500">2 hours ago</span>
                                <span class="ml-2 w-2 h-2 bg-lime-500 rounded-full"></span>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">
                            Full Stack Developer at TechCorp | React | Node.js | MongoDB
                        </p>
                        <div class="mt-2 flex space-x-2">
                            <button class="px-3 py-1 bg-lime-500 text-white text-xs font-medium rounded hover:bg-lime-600">
                                Accept
                            </button>
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300">
                                Decline
                            </button>
                        </div>
                    </div>
                </div> --}}
                
                <!-- Unread Comment Notification -->
                <div class="p-4 flex items-start space-x-4 bg-lime-50">
                    <div class="relative flex-shrink-0">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="h-12 w-12 rounded-full">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-900">
                                <span class="font-semibold">Alex Johnson</span> commented on your post <span class="text-lime-600">"How to structure large React applications"</span>
                            </p>
                            <div class="flex items-center">
                                <span class="text-xs text-gray-500">5 hours ago</span>
                                <span class="ml-2 w-2 h-2 bg-lime-500 rounded-full"></span>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">
                            "This is exactly what I needed! I've been struggling with component organization for weeks..."
                        </p>
                        <button class="mt-2 text-xs font-medium text-lime-600 hover:text-lime-800">
                            Reply to comment
                        </button>
                    </div>
                </div>
                
                <!-- Read Like Notification -->
                {{-- <div class="p-4 flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-900">
                                <span class="font-semibold">5 people</span> liked your comment on <span class="text-lime-600">@davidmiller</span>'s post
                            </p>
                            <span class="text-xs text-gray-500">Yesterday</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-600 italic">
                            "Try using React Query for state management. It will simplify your code a lot!"
                        </p>
                    </div>
                </div> --}}
                
                <!-- Read Mention Notification -->
                {{-- <div class="p-4 flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile" class="h-12 w-12 rounded-full">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-900">
                                <span class="font-semibold">Sarah Parker</span> mentioned you in a comment
                            </p>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">
                            "I think <span class="text-lime-600">@username</span> would be the perfect person to help with this Docker issue!"
                        </p>
                        <button class="mt-2 text-xs font-medium text-lime-600 hover:text-lime-800">
                            View comment
                        </button>
                    </div>
                </div> --}}
                
                <!-- System Notification -->
                {{-- <div class="p-4 flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-lime-100 flex items-center justify-center text-lime-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-medium text-gray-900">
                                Your account has been verified
                            </p>
                            <span class="text-xs text-gray-500">1 week ago</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">
                            Your developer profile has been verified. You now have access to all platform features.
                        </p>
                    </div>
                </div> --}}
            </div>
            
            <!-- Load More -->
            <div class="mt-6 text-center">
                <button class="inline-flex items-center px-4 py-2 border border-lime-300 rounded-md shadow-sm text-sm font-medium text-lime-700 bg-white hover:bg-lime-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-lime-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    Load more
                </button>
            </div>
        </div>
    </div>
</x-app-layout>