<x-app-layout>
    <div class="bg-gray-50 h-screen pt-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-[calc(100vh-5rem)]">
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
                    <div class="flex-1 overflow-y-auto" id="connections-list">
                        <div class="divide-y divide-gray-200">
                            @forelse($connections as $connection)
                                @php
                                    $otherUser = $connection->other_user;
                                    // You would add logic here to detect unread messages
                                    $hasUnread = false; // Replace with actual unread detection
                                @endphp
                                
                                <div class="connection-item px-4 py-3 hover:bg-gray-50 cursor-pointer transition duration-150 ease-in-out"
                                     data-user-id="{{ $otherUser->id }}"
                                     data-user-name="{{ $otherUser->name }}"
                                     data-user-photo="{{ $otherUser->profile_image ? Storage::url($otherUser->profile_image)  : "https://www.iconpacks.net/icons/2/free-user-icon-3297-thumb.png"}}">
                                    <div class="flex items-center">
                                        <div class="relative flex-shrink-0">
                                            <img src="{{ $otherUser->profile_image ? Storage::url($otherUser->profile_image) : "https://www.iconpacks.net/icons/2/free-user-icon-3297-thumb.png" }}" 
                                                 alt="Profile" 
                                                 class="h-12 w-12 rounded-full object-cover">
                                            <div class="absolute bottom-0 right-0 bg-green-500 h-3 w-3 rounded-full border-2 border-white"></div>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex justify-between items-center">
                                                <h3 class="text-sm font-semibold text-gray-900">{{ $otherUser->name }}</h3>
                                                <span class="text-xs text-gray-500 message-timestamp">12:42 PM</span>
                                            </div>
                                            <p class="text-sm text-gray-600 truncate message-preview">Click to view conversation</p>
                                            
                                            @if($hasUnread)
                                                <span class="inline-flex items-center justify-center px-2 py-1 mt-1 text-xs font-bold leading-none text-white bg-lime-600 rounded-full">
                                                    New
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 px-6 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                    <p class="mt-2">No connections yet</p>
                                    <p class="text-sm mt-1">Connect with other developers to start chatting</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Right side - Current conversation -->
                <div class="w-2/3 flex flex-col bg-white">
                    <!-- Chat header -->
                    <div class="px-6 py-3 border-b flex items-center justify-between" id="chat-header">
                        <div class="flex items-center">
                            <div class="relative">
                                <img src="https://www.iconpacks.net/icons/2/free-user-icon-3297-thumb.png" alt="User" class="h-10 w-10 rounded-full object-cover" id="chat-user-avatar">
                                <div class="absolute bottom-0 right-0 bg-green-500 h-2.5 w-2.5 rounded-full border-2 border-white" id="chat-user-status-indicator"></div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900" id="chat-user-name">Select a conversation</h3>
                                <p class="text-xs text-gray-500" id="chat-user-status">---</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 rounded-full hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50" id="messages-container">
                        <!-- Empty state - shown initially -->
                        <div class="flex items-center justify-center h-full text-gray-500 flex-col" id="empty-state">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p>Select a conversation to start chatting</p>
                        </div>

                        <!-- Messages will be inserted here by JavaScript -->
                    </div>
                    
                    <!-- Message input -->
                    <div class="p-4 border-t hidden" id="message-input-container">
                        <form id="message-form" class="flex items-center space-x-2">
                            <button type="button" class="p-2 text-gray-500 hover:text-lime-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <button type="button" class="p-2 text-gray-500 hover:text-lime-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <textarea id="message-input" 
                                class="flex-1 py-2 px-4 bg-gray-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:bg-white focus:border-lime-500 resize-none"
                                placeholder="Type a message..." rows="1"></textarea>
                            <button type="submit" class="p-2 bg-lime-600 text-white rounded-full hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500">
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
        document.addEventListener('DOMContentLoaded', function() {
            const userId = {{ Auth::id() }};
            let currentRecipientId = null;

            const connectionsList = document.getElementById('connections-list');
            const messagesContainer = document.getElementById('messages-container');
            const emptyState = document.getElementById('empty-state');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const messageInputContainer = document.getElementById('message-input-container');
            const chatUserName = document.getElementById('chat-user-name');
            const chatUserStatus = document.getElementById('chat-user-status');
            const chatUserAvatar = document.getElementById('chat-user-avatar');
            
            // Listen for clicks on any connection item
            connectionsList.addEventListener('click', function(event) {
                const connectionItem = event.target.closest('.connection-item');
                if (!connectionItem) return;
                
                currentRecipientId = connectionItem.dataset.userId;

                // Update header with user info
                chatUserName.textContent = connectionItem.dataset.userName;
                chatUserStatus.textContent = 'Online';
                chatUserAvatar.src = connectionItem.dataset.userPhoto;

                // Clear previous messages
                messagesContainer.innerHTML = '';

                // Hide empty state and show message input
                emptyState.style.display = 'none';
                messageInputContainer.classList.remove('hidden');

                // Load messages for this user
                loadMessages(currentRecipientId);

                // Highlight selected connection and remove any unread indicators
                document.querySelectorAll('.connection-item').forEach(item => {
                    item.classList.remove('bg-lime-50', 'border-l-4', 'border-lime-500');
                });
                connectionItem.classList.add('bg-lime-50', 'border-l-4', 'border-lime-500');
                
                // Remove unread badge if exists
                const unreadBadge = connectionItem.querySelector('.bg-lime-600');
                if (unreadBadge) unreadBadge.remove();
            });

            // Handle sending a message
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!currentRecipientId || !messageInput.value.trim()) return;

                const msgText = messageInput.value.trim();

                // Reset input
                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Optimistically display the outgoing message
                appendMessage({
                    id: 'temp-' + Date.now(),
                    from_user_id: userId,
                    message: msgText,
                    created_at: new Date().toISOString(),
                    pending: true
                }, true);

                // Send to server
                fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ recipient_id: currentRecipientId, message: msgText })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return res.json();
                })
                .then(data => {
                    console.log('Message sent:', data);
                    
                    // Update the message preview in the conversations list
                    updateConversationPreview(currentRecipientId, msgText, 'Just now');
                })
                .catch(err => {
                    console.error('Send error:', err);
                    // Show error state
                    const errorMsg = document.querySelector(`[data-message-id="temp-${Date.now()}"]`);
                    if (errorMsg) {
                        errorMsg.classList.add('opacity-50');
                        errorMsg.querySelector('.message-status').innerHTML = `
                            <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        `;
                    }
                });
            });

            // Load messages from server
            function loadMessages(recipientId) {
                // Show loading indicator
                messagesContainer.innerHTML = `
                    <div class="flex justify-center py-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-lime-600"></div>
                    </div>
                `;

                fetch(`{{ url('chat/messages') }}/${recipientId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch messages');
                    }
                    return response.json();
                })
                .then(messages => {
                    // Clear messages container
                    messagesContainer.innerHTML = '';
                    
                    if (!messages || messages.length === 0) {
                        messagesContainer.innerHTML = `
                            <div class="flex justify-center py-8">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    <p class="mt-2 text-gray-500">No messages yet</p>
                                    <p class="text-sm text-gray-400">Be the first to say hello!</p>
                                </div>
                            </div>
                        `;
                    } else {
                        // Group messages by date
                        let currentDate = null;
                        
                        messages.forEach((message, index) => {
                            const messageDate = new Date(message.created_at).toLocaleDateString();
                            
                            // Add date separator if this is a new date
                            if (messageDate !== currentDate) {
                                const dateSeparator = document.createElement('div');
                                dateSeparator.className = 'flex items-center justify-center my-4';
                                dateSeparator.innerHTML = `
                                    <span class="px-4 py-1 bg-gray-200 rounded-full text-xs text-gray-600">
                                        ${formatMessageDate(message.created_at)}
                                    </span>
                                `;
                                messagesContainer.appendChild(dateSeparator);
                                currentDate = messageDate;
                            }
                            
                            const isSentByMe = (message.from_user_id == userId);
                            appendMessage(message, isSentByMe);
                            
                            // If it's the first message, update the conversation preview
                            if (index === messages.length - 1) {
                                updateConversationPreview(
                                    isSentByMe ? message.to_user_id : message.from_user_id, 
                                    message.message, 
                                    formatTime(message.created_at)
                                );
                            }
                        });
                    }
                    
                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                })
                .catch(err => {
                    console.error('Load error:', err);
                    messagesContainer.innerHTML = `
                        <div class="flex justify-center py-8">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="mt-2 text-red-500">Could not load messages</p>
                                <button class="mt-2 text-sm text-lime-600 hover:underline" onclick="loadMessages(${recipientId})">
                                    Try again
                                </button>
                            </div>
                        </div>
                    `;
                });
            }

            // Display a single message in UI
            function appendMessage(message, isSent) {
                const msgElement = document.createElement('div');
                msgElement.className = `mb-4 ${isSent ? 'flex justify-end' : 'flex justify-start'}`;
                msgElement.setAttribute('data-message-id', message.id);
                
                const msgText = message.message;
                const msgTime = formatTime(message.created_at);
                const isPending = message.pending;

                if (isSent) {
                    msgElement.innerHTML = `
                        <div class="max-w-xs lg:max-w-md">
                            <div class="bg-lime-600 text-white rounded-t-lg rounded-bl-lg px-4 py-2 shadow">
                                <p>${escapeHTML(msgText)}</p>
                            </div>
                            <div class="flex justify-end items-center mt-1 space-x-1">
                                <span class="text-xs text-gray-500">${msgTime}</span>
                                <span class="message-status">
                                    ${isPending ? 
                                        '<svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' : 
                                        '<svg class="h-3 w-3 text-lime-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'}
                                </span>
                            </div>
                        </div>
                    `;
                } else {
                    msgElement.innerHTML = `
                        <div class="max-w-xs lg:max-w-md">
                            <div class="bg-white rounded-t-lg rounded-br-lg px-4 py-2 shadow border border-gray-200">
                                <p>${escapeHTML(msgText)}</p>
                            </div>
                            <div class="mt-1">
                                <span class="text-xs text-gray-500">${msgTime}</span>
                            </div>
                        </div>
                    `;
                }

                messagesContainer.appendChild(msgElement);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Update the preview of a conversation in the sidebar
            function updateConversationPreview(userId, message, time) {
                const conversationItem = document.querySelector(`.connection-item[data-user-id="${userId}"]`);
                if (!conversationItem) return;
                
                // Update message preview
                const previewElement = conversationItem.querySelector('.message-preview');
                if (previewElement) previewElement.textContent = message;
                
                // Update timestamp
                const timestampElement = conversationItem.querySelector('.message-timestamp');
                if (timestampElement) timestampElement.textContent = time;
                
                // Move to top of list (optional)
                const parent = conversationItem.parentNode;
                if (parent && parent.firstChild !== conversationItem) {
                    parent.insertBefore(conversationItem, parent.firstChild);
                }
            }

            // Add unread indicator to a conversation
            function markConversationUnread(userId) {
                const conversationItem = document.querySelector(`.connection-item[data-user-id="${userId}"]`);
                if (!conversationItem) return;
                
                // Don't add badge if this is the current conversation
                if (currentRecipientId === userId) return;
                
                // Check if badge already exists
                let badge = conversationItem.querySelector('.bg-lime-600');
                if (!badge) {
                    const container = conversationItem.querySelector('.ml-3');
                    badge = document.createElement('span');
                    badge.className = 'inline-flex items-center justify-center px-2 py-1 mt-1 text-xs font-bold leading-none text-white bg-lime-600 rounded-full';
                    badge.textContent = 'New';
                    container.appendChild(badge);
                }
            }

            // Escape HTML to prevent XSS
            function escapeHTML(str) {
                return str
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            // Format time from ISO string
            function formatTime(isoString) {
                const date = new Date(isoString);
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
            
            // Format message date for date separators
            function formatMessageDate(isoString) {
                const date = new Date(isoString);
                const today = new Date();
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                
                if (date.toDateString() === today.toDateString()) {
                    return 'Today';
                } else if (date.toDateString() === yesterday.toDateString()) {
                    return 'Yesterday';
                } else {
                    return date.toLocaleDateString(undefined, { weekday: 'long', month: 'short', day: 'numeric' });
                }
            }

            // Listen for incoming messages via Pusher/Echo
            if (window.Echo) {
                window.Echo.private(`chat.${userId}`)
                    .listen('.new.message', data => {
                        console.log('Received message:', data);
                        
                        // If we're currently chatting with this person, show the message
                        if (currentRecipientId == data.from_user_id) {
                            // Add a date separator if needed
                            const messageDate = new Date(data.created_at).toLocaleDateString();
                            const lastDate = messagesContainer.lastElementChild?.getAttribute('data-date');
                            
                            if (messageDate !== lastDate) {
                                const dateSeparator = document.createElement('div');
                                dateSeparator.className = 'flex items-center justify-center my-4';
                                dateSeparator.innerHTML = `
                                    <span class="px-4 py-1 bg-gray-200 rounded-full text-xs text-gray-600">
                                        ${formatMessageDate(data.created_at)}
                                    </span>
                                `;
                                messagesContainer.appendChild(dateSeparator);
                            }
                            
                            // Show the message
                            appendMessage({
                                id: data.id,
                                from_user_id: data.from_user_id,
                                to_user_id: data.to_user_id,
                                message: data.message,
                                created_at: data.created_at
                            }, false);
                            
                            // Play notification sound (optional)
                            playMessageSound();
                        }
                        
                        // Update the conversation preview
                        updateConversationPreview(
                            data.from_user_id, 
                            data.message, 
                            'Just now'
                        );
                        
                        // Mark conversation as unread if not the current conversation
                        markConversationUnread(data.from_user_id);
                    });
            }

            // Auto-resize textarea
            messageInput.addEventListener('input', () => {
                messageInput.style.height = 'auto';
                messageInput.style.height = (messageInput.scrollHeight < 100 ? messageInput.scrollHeight : 100) + 'px';
            });
            
            // Play message notification sound
            function playMessageSound() {
                // You can add a sound element to play for notifications
                const sound = new Audio('/sounds/message.mp3');
                sound.volume = 0.5;
                sound.play().catch(e => console.log('Could not play notification sound', e));
            }
        });
        
    </script>
</x-app-layout>