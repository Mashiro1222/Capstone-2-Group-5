@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Allergens Section -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-300 mb-4">Your Allergens</h2>

            <!-- Feedback Messages -->
            @if (session('error'))
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Allergen Form -->
            <form id="addAllergenForm" action="{{ route('profile.allergens.store') }}" method="POST">
                @csrf
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        id="allergen_name" 
                        name="allergen_name" 
                        placeholder="Enter an allergen (e.g., Peanuts)" 
                        class="rounded-lg px-4 py-2 border border-gray-600 bg-gray-700 text-black placeholder-gray-400 focus:ring-2 focus:ring-green-400 focus:outline-none w-full" 
                        autocomplete="off"
                        onkeyup="fetchAllergens()"
                        required>
                    <button type="submit" class="bg-white dark:text-gray-800 text-black rounded-lg px-4 py-2 hover:bg-green-600">
                        Add Allergen
                    </button>
                </div>
                <ul id="allergen_suggestions" class="bg-white border border-gray-300 rounded-lg mt-2 shadow-lg hidden">
                    <!-- Suggestions will be dynamically injected here -->
                </ul>
            </form>

            <!-- List of Allergens -->
            <div class="mt-4 bg-gray-700 p-4 rounded-lg">
                @forelse ($allergens as $allergen)
                    <div class="flex justify-between items-center border-b border-gray-600 py-2">
                        <span class="text-white">{{ $allergen->allergen_name }}</span>
        <!-- Edit and Delete Buttons -->
            <div class="flex gap-2">
                            <!-- Edit Button -->
                            <a 
                                href="{{ route('profile.allergens.edit', $allergen->id) }}" 
                                class="dark:text-gray-800 text-black bg-white hover:bg-blue-600 rounded-lg px-4 py-2 text-sm">
                                Edit
                            </a>
                            <!-- Delete Form -->
                            <form action="{{ route('profile.allergens.delete', $allergen->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="dark:text-gray-800text-white bg-white hover:bg-red-600 rounded-lg px-4 py-2 text-sm focus:outline-none"
                                    onclick="return confirm('Are you sure you want to delete this allergen?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No allergens added yet.</p>
                @endforelse
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

    <script>
        function fetchAllergens() {
            const input = document.getElementById('allergen_name').value;

            if (input.length < 1) {
                document.getElementById('allergen_suggestions').classList.add('hidden');
                return;
            }

            fetch(`/profile/allergens/suggestions?query=${input}`)
                .then(response => response.json())
                .then(data => {
                    const suggestionBox = document.getElementById('allergen_suggestions');
                    suggestionBox.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.className = 'px-4 py-2 cursor-pointer hover:bg-gray-100';
                            li.innerText = item.name;
                            li.onclick = () => {
                                document.getElementById('allergen_name').value = item.name;
                                suggestionBox.classList.add('hidden');
                            };
                            suggestionBox.appendChild(li);
                        });
                        suggestionBox.classList.remove('hidden');
                    } else {
                        suggestionBox.classList.add('hidden');
                    }
                })
            .catch(error => console.error('Error fetching allergen suggestions:', error));
        }
    </script>
@endsection
