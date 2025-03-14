<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
     <!-- Navigation -->
    

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto pt-20 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Profile Card -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <div class="h-24 bg-gradient-to-r from-lime-600 to-lime-400"></div>
                        @empty ($user->profile_image)
                        <img src="https://avatar.iran.liara.run/public/boy" alt="Profile" 
                        class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-white shadow-md"/>
                        @else
                        <img src="{{Storage::url($user->profile_image)}}" alt="Profile" 
                        class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-white shadow-md"/>
                     
                      
                        @endempty
                    </div>
                    <div class="pt-14 p-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold">{{$user->name}}</h2>
                            <a href="{{$user->github_url}}" target="_blank" class="text-gray-600 hover:text-black">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">{{$user->headline}}</p>
                        <p class="text-gray-500 text-sm mt-2">{{$user->bio}}</p>
                        
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($languages as $item)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{$item->name}}</span>
                            @endforeach
                            {{-- <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">JavaScript</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Node.js</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">React</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Python</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Docker</span> --}}
                        </div>

                        <div class="mt-4 pt-4 border-t">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Connections</span>
                                <span class="text-blue-600 font-medium">{{count($connections)}}</span>
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-gray-500">Posts</span>
                                <span class="text-blue-600 font-medium">{{count($posts)}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                {{-- <div class="bg-white rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold mb-4">Trending Tags</h3>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">#javascript</span>
                            <span class="text-gray-400 text-sm">2.4k</span>
                        </a>
                        <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">#react</span>
                            <span class="text-gray-400 text-sm">1.8k</span>
                        </a>
                        <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">#webdev</span>
                            <span class="text-gray-400 text-sm">1.2k</span>
                        </a>
                    </div>
                </div> --}}
            </div>

            <!-- Main Feed -->  
            <div class="lg:col-span-2 space-y-6">
                <!-- Post Creation -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center space-x-4">
                        @empty($user->profile_image)
                        <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full"/>
                        @else
                         <img src="{{Storage::url($user->profile_image)}}" alt="User" class="w-12 h-12 rounded-full"/>
                        @endempty
                       
                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-500 text-left rounded-lg px-4 py-3 flex-grow transition-colors duration-200" onclick="togglePostForm()">
                            Share your knowledge or ask a question...
                        </button>
                        @foreach ($errors as $error)
                            <div class="text-red-500">{{$error}}</div>
                            
                        @endforeach
                        
                        
                        <div id="post-form" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
                            <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg overflow-hidden">
                                <div class="flex justify-between items-center border-b p-4">
                                    <h3 class="font-semibold text-lg text-lime-700">Create Post</h3>
                                    <button type="button" onclick="togglePostForm()" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                {{-- <form action="" method="POST" enctype="multipart/form-data" class="p-4"> --}}
                                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                                    @csrf
                                    
                                    <div class="mb-4">
                                        <textarea name="content" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-lime-500 focus:border-lime-500" 
                                            rows="4" placeholder="What do you want to share with the community?" required></textarea>
                                    </div>
                                    
                                    <div class="border rounded-lg p-4 mb-4 bg-gray-50">
                                        <h4 class="font-medium text-sm text-gray-700 mb-3">Add to your post</h4>
                                        
                                        <div class="space-y-4">
                                            <!-- Code Snippet -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Code Snippet</label>
                                                <textarea name="code" class="w-full p-2 border border-gray-300 bg-gray-900 text-gray-100 font-mono text-sm rounded-lg" 
                                                    rows="3" placeholder="// Your code here"></textarea>
                                            </div>
                                            
                                            <!-- Tags -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                                <input type="text" name="tags" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-lime-500 focus:border-lime-500" 
                                                    placeholder="javascript, react, webdev (comma separated)">
                                            </div>
                                            
                                            <!-- Image Upload with Preview -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                                <div class="flex items-center">
                                                    <label class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                                        <svg class="w-5 h-5 text-lime-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        <span class="text-sm text-gray-700">Choose File</span>
                                                        <input type="file" name="image" class="hidden" id="post-image"
                                                            onchange="previewImage(event)">
                                                    </label>
                                                    <span id="file-name" class="ml-3 text-sm text-gray-500">No file chosen</span>
                                                </div>
                                                <div id="image-preview" class="mt-2 hidden">
                                                    <img src="" alt="Preview" class="max-h-40 rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                            Post
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <script>
                            function togglePostForm() {
                                const form = document.getElementById('post-form');
                                form.classList.toggle('hidden');
                                document.body.classList.toggle('overflow-hidden');
                            }
                            
                            function previewImage(event) {
                                const input = event.target;
                                const preview = document.getElementById('image-preview');
                                const fileName = document.getElementById('file-name');
                                
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();
                                    
                                    reader.onload = function(e) {
                                        preview.querySelector('img').src = e.target.result;
                                        preview.classList.remove('hidden');
                                        fileName.textContent = input.files[0].name;
                                    }
                                    
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>

                    </div>
                    <div class="flex justify-between mt-4 pt-4 border-t">
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            <span>Code</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Image</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            <span>Link</span>
                        </button>
                    </div>
                </div>

                <!-- Posts -->
                @foreach ($posts as $post)
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{Storage::url($post->user->profile_image)}}" alt="User" class="w-12 h-12 rounded-full"/>
                                <div>
                                    <h3 class="font-semibold">{{$post->user->name}}</h3>
                                    <p class="text-gray-500 text-sm">{{$post->user->headline}}</p>
                                    <p class="text-gray-400 text-xs"> {{$post->created_at->diffForHumans()}} </p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-gray-700">{{$post->content}}</p>
                            
                            <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200">
                                {{-- <pre><code>
                                        const redis = require('redis');
                                        const client = redis.createClient();
                                        
                                        async function getCachedData(key) {
                                        const cached = await client.get(key);
                                        if (cached) {
                                            return JSON.parse(cached);
                                        }
                                        
                                        const data = await fetchDataFromDB();
                                        await client.setEx(key, 3600, JSON.stringify(data));
                                        return data;
                                        }
                                </code></pre> --}}
                                <img src="{{Storage::url($post->image)}}" alt="">
                            </div>
            
                            <div class="mt-4 flex flex-wrap gap-2">
                                @php
                                    $tags = json_decode($post->tags);
                                   
                                @endphp

                                @foreach ( $tags as $tag)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{$tag }}</span> 
                                @endforeach
                                
                            </div>
            
                            <div class="mt-4 flex items-center justify-between border-t pt-4">
                                <div class="flex items-center space-x-4">
                                    {{-- <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 like-btn" class="like-btn" data-post-id="{{ $post->id }}">
                                        @if ($post->isLikedByUser($post->user->id) == 'liked')
                                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                            </svg>
                                            <span>{{count($post->likes)}}</span>
                                           
                                            
                                        @else
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                        </svg>
                                        <span>{{count($post->likes)}}</span>
                                        @endif
                                       
                                    </button> --}}
                                    <button onclick="toggleLike({{$post->id}})"
                                        class="like-button flex items-center space-x-2 hover:text-blue-600"
                                        data-post-id="{{ $post->id }}">
                                        <svg class="h-5 w-5 like-icon" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        <span class="likes-count">{{ $post->likes->count() }}</span>
                                        <span>likes</span>
                                    </button>
                                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                        <span>{{count($post->comments )}}</span>
                                    </button>
                                </div>
                                <button class="text-gray-500 hover:text-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <div class="max-h-40  overflow-auto">
                                    <div >
                                        {{-- commentiare of users --}}
                                        {{-- @foreach ($post->comments as $comment) --}}
                                        @foreach ($post->comments as $comment)
                                        <div>
                                            <div class="flex items-center space-x-4 mt-4">
                                                @empty($comment->user->profile_image)
                                                <img src="https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" alt="User" class="w-10 h-10 rounded-full"/>
                                                    @else
                                                    <img src="{{Storage::url($comment->user->profile_image)}}" alt="User" class="w-10 h-10 rounded-full"/>
                                                @endempty
                                               
                                                <div>
                                                    <h3 class="font-semibold">{{$comment->user->name}}</h3>
                                                    <p class="text-gray-500 text-sm">{{$comment->comment}}</p>
                                                    <p class="text-gray-400 text-xs"> {{$comment->created_at->diffForHumans()}} </p>
                                            </div>
                                        </div>
                                        @endforeach   
                                    </div>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                    {{-- <form action="" method="POST"> --}}
                                        @csrf
                                        <input type="text" name="comment" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-lime-500 focus:border-lime-500" 
                                            placeholder="Add a comment..." required>
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                            Comment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
                <script>
                    document.querySelectorAll('.like-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            let postId = this.getAttribute('data-post-id');
                            
                            fetch(`/posts/${postId}/like`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => response.json())
                            .then(data => {
                                
                                location.reload();
                            }).catch(error => console.error(error));
                        });
                    });
                </script>
                
                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Job Recommendations -->
                    
            
                    <!-- Suggested Connections -->
                   
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('.like-button').forEach(button => {
                            const postId = button.dataset.postId;
                            checkLikeStatus(postId);
                        });
                    });

                    async function toggleLike(postId) {
            try {
                const response = await fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const button = document.querySelector(`.like-button[data-post-id="${postId}"]`);
                    const icon = button.querySelector('.like-icon');
                    const count = button.querySelector('.likes-count');
                    
                    // Update like count
                    count.textContent = data.likesCount;
                    
                    // Update icon state
                    if (data.isLiked) {
                        icon.style.fill = 'currentColor';
                    } else {
                        icon.style.fill = 'none';
                    }
                }
                } catch (error) {
                    console.error('Error toggling like:', error);
                }
                }
                async function checkLikeStatus(postId) {
                    try {
                        const response = await fetch(`/posts/${postId}/check-like`);
                        const data = await response.json();
                        
                        const button = document.querySelector(`.like-button[data-post-id="${postId}"]`);
                        const icon = button.querySelector('.like-icon');
                        
                        if (data.isLiked) {
                            icon.style.fill = 'currentColor';
                        }
                    } catch (error) {
                        console.error('Error checking like status:', error);
                    }
                }
                </script>
</x-app-layout>
