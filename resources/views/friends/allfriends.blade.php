<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-[1400px] mx-auto px-4">
            <!-- Network Stats -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-4">Your Network</h1>
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <span class="block text-2xl font-bold text-lime-600">{{ count($connections)}}</span>
                        {{-- <span class="block text-2xl font-bold text-lime-600">11</span> --}}
                        <span class="text-sm text-gray-600">Connections</span>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <span class="block text-2xl font-bold text-lime-600">{{ count($pandingRequests) }}</span>
                        {{-- <span class="block text-2xl font-bold text-lime-600">15</span> --}}
                        <span class="text-sm text-gray-600">Pending</span>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <span class="block text-2xl font-bold text-lime-600">{{ count($followers) }}</span>
                        {{-- <span class="block text-2xl font-bold text-lime-600">15</span> --}}
                        <span class="text-sm text-gray-600">followers</span>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <span class="block text-2xl font-bold text-lime-600">{{ count($following) }}</span>
                        {{-- <span class="block text-2xl font-bold text-lime-600">15</span> --}}
                        <span class="text-sm text-gray-600">following</span>
                    </div>
                  
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Pending Invitations -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold text-gray-900">Pending Invitations</h2>
                    </div>
                    <div class="divide-y max-h-[600px] overflow-y-auto">
                        @forelse ($pandingRequests as $request)
                        <div class="p-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $request->sender->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($request->sender->name) }}" 
                                     alt="{{ $request->sender->name }}" 
                                     class="w-12 h-12 rounded-full">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $request->sender->name }}</h3>
                                    <p class="text-xs text-gray-600 truncate">{{ $request->sender->headline ?? 'Developer' }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2 mt-3">
                                {{-- <button onclick="acceptRequest({{ $request->sender->id }})" 
                                        class="flex-1 px-3 py-1.5 bg-lime-600 text-white rounded-full hover:bg-lime-700 text-sm">
                                    Accept
                                </button> --}}
                                <form class="w-1/2" action="{{route("connections.accept", $request->sender->id )}}" method="POST">
                                    @csrf
                                    @method("POST")
                                    <button type="submit"  class=" w-full flex-1 px-3 py-1.5 bg-lime-600 text-white rounded-full hover:bg-lime-700 text-sm">Accept</button>
                                </form>
                                {{-- <button onclick="ignoreRequest({{ $request->sender->id }})" 
                                        class="flex-1 px-3 py-1.5 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 text-sm">
                                    Ignore
                                </button> --}}
                                <form class="w-1/2" action="{{route("connections.ignore" , $request->sender->id )}}" method="POST">
                                    @csrf
                                    @method("POST")
                                    <button type="submit" class=" w-full flex-1 px-3 py-1.5 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 text-sm">Ignore</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-500">
                            No pending invitations
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Current Connections -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold text-gray-900">Your Connections</h2>
                    </div>
                    <div class="divide-y max-h-[600px] overflow-y-auto">
                        @forelse ($connections as $connection)
                        <div class="p-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $connection->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($connection->name) }}" 
                                     alt="{{ $connection->name }}" 
                                     class="w-12 h-12 rounded-full">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $connection->name }}</h3>
                                        <button onclick="removeConnection({{ $connection->id }})" 
                                                class="text-gray-400 hover:text-lime-600">
                                            {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg> --}}
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-600 truncate">{{ $connection->headline ?? 'Developer' }}</p>
                                    <p class="text-xs text-gray-500">Connected {{ $connection->pivot?->created_at->diffForHumans() ?? 'recently' }}</p>
                                    <div class="flex space-x-2 mt-3">
                                        <form action="" class="w-1/2">  
                                            <button type="submit"  class="mt-2 w-full px-3 py-1.5 border border-lime-600 text-lime-600 rounded-full hover:bg-lime-50 text-sm flex items-center justify-center">message</button>
                                        </form>
                                        <form action="{{route("connections.remove" ,  $connection->id  )}}" method="POST" class="w-1/2">
                                            @csrf
                                            @method("delete")
                                            <button type="submit"  class="mt-2 w-full px-3 py-1.5 border border-lime-600 text-lime-600 rounded-full hover:bg-lime-50 text-sm flex items-center justify-center">delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-500">
                            No connections yet
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- People You May Know -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold text-gray-900">People You May Know</h2>
                    </div>
                    <div class="divide-y max-h-[600px] overflow-y-auto">
                        @forelse ($otherusers as $suggestion)
                        <div class="p-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $suggestion->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($suggestion->name) }}" 
                                     alt="{{ $suggestion->name }}" 
                                     class="w-12 h-12 rounded-full">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $suggestion->name }}</h3>
                                    <p class="text-xs text-gray-600 truncate">{{ $suggestion->headline ?? 'Developer' }}</p>
                                    {{-- <button onclick="sendRequest({{ $suggestion->id }})" 
                                            class="mt-2 w-full px-3 py-1.5 border border-lime-600 text-lime-600 rounded-full hover:bg-lime-50 text-sm flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Connect
                                    </button> --}}
                                    @if ($suggestion->status == 'pending')
                                    <button class="mt-2 w-full px-3 py-1.5 border border-lime-600 text-lime-600 rounded-full hover:bg-lime-50 text-sm flex items-center justify-center">  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <i class="mr-4 fa-solid fa-hourglass-start"></i>
                                    </svg> Pending</button>
                                    @else
                                    <form action="{{route("connections.send" , $suggestion->id) }}" method="POST">
                                        @csrf
                                        @method("POST")
                                        <button type="submit" class="mt-2 w-full px-3 py-1.5 border border-lime-600 text-lime-600 rounded-full hover:bg-lime-50 text-sm flex items-center justify-center">  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg> Connect</button>
                                    </form>
                                        
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-500">
                            No suggestions available
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    
    </script>
    @endpush
</x-app-layout>