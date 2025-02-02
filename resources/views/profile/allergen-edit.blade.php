@extends('layouts.app')

@section('content')
<div class="bg-gray-800 max-w-3xl mx-auto px-8 py-6 rounded-xl shadow-lg mt-12">
    <h1 class="text-2xl font-bold text-white mb-6 text-center">Edit Allergen</h1>

    <form action="{{ route('profile.allergens.update', $allergen->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-6 relative">
            <label for="allergen_name" class="block text-sm font-medium text-gray-300 mb-2">Allergen Name</label>
            <input 
                type="text" 
                name="allergen_name" 
                id="allergen_name" 
                value="{{ $allergen->allergen_name }}" 
                class="w-full px-4 py-2 rounded-lg border border-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                onkeyup="fetchAllergens()" 
                required>
            
            <!-- Suggestions Box -->
            <ul id="allergen_suggestions" class="absolute bg-white text-black border rounded-lg mt-2 shadow-lg hidden"></ul>
        </div>
    </form>

    <div class="flex justify-center gap-4 mt-8">
        <a href="{{ route('profile.edit') }}" class="bg-gray-500 text-white rounded-lg px-6 py-2 hover:bg-gray-600">
            Cancel
        </a>
        <form action="{{ route('profile.allergens.update', $allergen->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-gray-500 text-white rounded-lg px-6 py-2 hover:bg-blue-600">
                Update Allergen
            </button>
        </form>
        <form action="{{ route('profile.allergens.delete', $allergen->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-gray-500 text-white rounded-lg px-6 py-2 hover:bg-red-600">
                Delete Allergen
            </button>
        </form>
    </div>
</div>

<script>
    function fetchAllergens() {
        const input = document.getElementById('allergen_name').value;
        const suggestionBox = document.getElementById('allergen_suggestions');

        if (!suggestionBox) {
            console.error('Suggestion box element not found in the DOM');
            return;
        }

        if (input.length < 1) {
            suggestionBox.classList.add('hidden');
            return;
        }

        fetch(`/profile/allergens/suggestions?query=${input}`)
            .then(response => response.json())
            .then(data => {
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
