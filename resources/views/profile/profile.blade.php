<x-app-layout>
    <div class="min-h-screen flex flex-col">
      <!-- Profile Header -->
      <div class="relative">

        <!-- Cover Photo -->
        <div class="relative w-full h-64 overflow-hidden rounded">
          <!-- Cover Image -->
          @empty($user->cover_image)
           <img src="https://codetheweb.blog/assets/img/posts/css-advanced-background-images/cover.jpg" alt="Cover Picture" class="w-full h-full object-cover">
          @else
           <img src="{{Storage::url($user->cover_image)}}" alt="Cover Picture" class="w-full h-full object-cover">
          @endempty
          {{-- <!-- Form for Uploading New Cover {{ route('profile.cover') }} --> --}}
          <form action="{{ route('profile.cover') }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-end justify-end p-4"> @csrf
            <!-- Styled File Input -->
            @method("PATCH")
            <input type="file" name="cover_image" id="cover_image" class="hidden" onchange="this.form.submit()">
            <label for="cover_image" class="cursor-pointer bg-white p-2 rounded shadow-md hover:bg-gray-100 focus:outline-none">
              <i class="fas fa-camera text-gray-600 mr-2"></i>Edit cover photo </label>
          </form>
        </div>

        <!-- Profile Info -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
          <div class="-mt-24 sm:-mt-32 sm:flex sm:items-end sm:space-x-5">
            <div class="relative group">
              {{-- {{route('profile.self')}} --}}
              <form action="{{route("profile.image.update")}}" method="POST" enctype="multipart/form-data" class="relative w-fit"> @csrf
                <!-- Profile Picture Container -->
                @method("PATCH")
                <div class="h-32 w-32 sm:h-40 sm:w-40 rounded-full ring-4 ring-white overflow-hidden bg-white relative"> @empty($user->profile_image) <img src="https://static.vecteezy.com/system/resources/thumbnails/006/487/917/small_2x/man-avatar-icon-free-vector.jpg" alt="Cover Picture" class="w-full h-full object-cover"> @else <img src="{{Storage::url($user->profile_image)}}" alt="Cover Picture" class="w-full h-full object-cover"> @endempty 
                  <!-- Hidden File Input -->
                  <input type="file" name="profile_image" id="profile_image" class="hidden" onchange="this.form.submit()">
                  <!-- Upload Button -->
                  <label for="profile_image" class="absolute bottom-4 right-4 text-center bg-gray-50 p-2 shadow-md cursor-pointer hover:bg-gray-100 w-10 h-10 rounded-full">
                    <i class="fas fa-camera text-gray-600"></i>
                  </label>
                </div>
              </form>
            </div>
            <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
              <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                <h1 class="text-2xl font-bold text-gray-900 truncate">{{$user->name}}</h1>
                <p class="text-gray-500">{{$user->headline}}</p>
                
              </div>
              <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                <a href="{{route('profile.edit')}}" type="button" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-lime-600 hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                  <i class="fas fa-pen -ml-1 mr-2"></i>
                  <span >Edit profile</span>
                </a>
              </div>
            </div>
          </div>
          <div class="hidden sm:block md:hidden mt-6 min-w-0 flex-1">
            <h1 class="text-2xl font-bold text-gray-900 truncate">{{$user->name}}</h1>
            <p class="text-gray-500">Full Stack Developer</p>
          </div>
        </div>
      </div>

      <!-- Profile Navigation -->

      <!-- Profile Content -->
      <div class="py-8 w-10/12 mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Column 1 -->
          <div class="lg:col-span-1">
            <!-- About Me -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
              <h2 class="text-lg font-medium text-gray-900 mb-4">About</h2>
              <p class="text-gray-600 mb-4">{{$user->bio??'try to add a bio'}} </p>
              <div class="border-t border-gray-200 pt-4 mt-2">
                <dl class="divide-y divide-gray-200">
                    <div class="py-3 flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">GitHub</dt>
                        <dd class="text-sm text-lime-600 hover:text-lime-700">
                          <a href="{{$user->github_url}}" class="flex items-center" target="_blank">
                            <i class="fab fa-github mr-1"></i> {{$user->name}}
                          </a>
                        </dd>
                    </div>
                  <div class="py-3 flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="text-sm text-gray-900">{{$user->location}}</dd>
                  </div>
                  <div class="py-3 flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Work</dt>
                    <dd class="text-sm text-gray-900">{{$user->work}}</dd>
                  </div>
                  <div class="py-3 flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Website</dt>
                    <dd class="text-sm text-lime-600 hover:text-lime-700">
                      <a href="{{$user->website}}" target="_te">{{$user->website}}</a>
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>

          <!-- Column 2-->
          <div class="lg:col-span-1">
            <!-- Skills -->
            <div class="bg-white shadow-2xl rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                  <h2 class="text-lg font-medium text-gray-900">Skills</h2>
                  <button onclick="openSkillModal()" class="text-sm text-lime-600 hover:text-lime-700">
                    <i class="fas fa-plus mr-1"></i> Add
                </button>
                <div id="skillModal" class="fixed inset-0 hidden">
                    <!-- Modal backdrop -->
                    <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
                    <!-- Modal content -->
                    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Add New Skill</h3>
                                    <button onclick="closeSkillModal()" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <form action="{{route("add.langue")}}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="skill" class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                                        <input type="text" name="skill" id="skill"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500">
                                    </div>
                                    <div class="flex justify-end gap-3">
                                        <button type="button" onclick="closeSkillModal()"
                                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 text-sm font-medium text-white bg-lime-600 hover:bg-lime-700 rounded-md">
                                            Add Skill
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    @empty($user->languages)
                        <span class="px-3 py-1 bg-lime-100 text-lime-800 rounded-full text-sm">No Languages added</span>
                    @else
                        @foreach($user->languages as $lan)
                            <span class="px-3 py-1 bg-lime-100 text-lime-800 rounded-full text-sm">{{ trim($lan->name) }}</span>
                        @endforeach
                    @endempty
                </div>
            </div>
            <!-- Projects -->

            <div class="lg:col-span-1">
                <!-- Projects -->
                <div class="bg-white shadow-2xl rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Latest Projects</h2>
                        <button onclick="openProjectModal()" class="text-sm text-lime-600 hover:text-lime-700">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                    <div class="space-y-4">
                        @forelse($user->projects ?? [] as $project)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-700">{{ $project->title }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ $project->project_url }}" target="_blank"
                                    class="text-lime-600 hover:text-lime-700">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="{{ $project->github_url }}" target="_blank"
                                    class="text-gray-600 hover:text-gray-700">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No projects added yet</p>
                        @endforelse
                    </div>
                </div>
                <!-- project modal -->
                <div id="projectModal" class="fixed inset-0 hidden">
                    <!-- Modal backdrop -->
                    <div class="absolute inset-0 bg-gray-900 opacity-70"></div>

                    <!-- Modal content -->
                    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Add New Project</h3>
                                    <button onclick="closeProjectModal()" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            {{-- @if ($errors->any())
                                <div id="error-messages">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-red-500">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif --}}
                                <form action="{{route('add.project')}}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                                        <input type="text" name="title" id="title" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 py-2">
                                    </div>
                                    <div class="mb-4">
                                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Project URL</label>
                                        <input type="url" name="project_url" id="url"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 py-2">
                                    </div>
                                    <div class="mb-4">
                                        <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                                        <input type="url" name="github_url" id="github_url"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 py-2">
                                    </div>
                                    <div class="flex justify-end gap-3">
                                        <button type="button" onclick="closeProjectModal()"
                                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 text-sm font-medium text-white bg-lime-600 hover:bg-lime-700 rounded-md">
                                            Add Project
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <!-- Column 3-->
          <div class="lg:col-span-1">
            <!-- Connections -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                  <h2 class="text-lg font-medium text-gray-900">Connections</h2>
                  <a href="#" class="text-sm text-lime-600 hover:text-lime-700">See all</a>
                </div>
                <div class="grid grid-cols-3 gap-4 min-w-1/3">
                  <div class="text-center">
                    <div class="relative group">
                      <img class="h-16 w-16 rounded-full mx-auto object-cover" src="{{Storage::url($user->profile_image)}}" alt="Connection 1">
                    </div>
                    <p class="mt-2 text-xs text-gray-500">{{$user->name}}</p>
                  </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <script>
        // skills modal
        function openSkillModal() {
            document.getElementById('skillModal').classList.remove('hidden');
        }

        function closeSkillModal() {
            document.getElementById('skillModal').classList.add('hidden');
        }
        // projects modal
        function openProjectModal() {
            document.getElementById('projectModal').classList.remove('hidden');
        }

        function closeProjectModal() {
            document.getElementById('projectModal').classList.add('hidden');
        }
    </script>
  </x-app-layout>
