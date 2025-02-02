@extends('layouts.app')

@section('content')
<div class="mt-6">
    <h2 class="text-lg font-bold mb-4">Your Allergens</h2>
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
                class="rounded-lg px-4 py-2 border focus:ring w-full" 
                autocomplete="off"
                onkeyup="fetchAllergens()"
                required>
            <button type="submit" class="bg-green-500 text-white rounded-lg px-4 py-2">
                Add Allergen
            </button>
        </div>
        <ul id="allergen_suggestions" class="bg-white border rounded-lg mt-2 shadow-lg hidden">
            <!-- Suggestions will be dynamically injected here -->
        </ul>
    </form>

    <!-- List of Allergens -->
    <div class="mt-4">
        @forelse ($allergens as $allergen)
            <div class="flex justify-between items-center border-b py-2">
                <span>{{ $allergen->allergen_name }}</span>
                <a 
                    href="{{ route('profile.allergens.edit', $allergen->id) }}" 
                    class="text-blue-500 hover:underline text-sm">
                    Edit
                </a>
            </div>
        @empty
            <p class="text-gray-500 text-sm">No allergens added yet.</p>
        @endforelse
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
        document.getElementById('allergen_name').addEventListener('keyup', function () {
        const input = this.value;

        if (input.length < 2) {
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
                        li.innerText = item.name || item.allergen_name; // Adjust this to match the field name in the response
                        li.onclick = () => {
                            document.getElementById('allergen_name').value = item.name || item.allergen_name; // Match the field name
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
        });
    </script>
@endsection
