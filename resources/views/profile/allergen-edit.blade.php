@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Allergen</h1>

    <!-- Feedback Messages -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Update Allergen Form -->
    <form action="{{ route('profile.allergens.update', $allergen->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="allergen_name" class="block text-sm font-medium text-gray-700">Allergen Name</label>
            <input 
                type="text" 
                name="allergen_name" 
                id="allergen_name" 
                value="{{ $allergen->allergen_name }}" 
                class="rounded-lg px-4 py-2 border focus:ring w-full" 
                required>
        </div>
        <div class="flex justify-between">
            <a href="{{ route('profile.edit') }}" class="bg-gray-500 text-white rounded-lg px-4 py-2 hover:bg-gray-600">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">
                Update Allergen
            </button>
        </div>
    </form>

    <!-- Delete Allergen Form -->
    <form action="{{ route('profile.allergens.delete', $allergen->id) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <div class="flex justify-end">
            <button type="submit" class="bg-red-500 text-white rounded-lg px-4 py-2 hover:bg-red-600">
                Delete Allergen
            </button>
        </div>
    </form>
</div>
@endsection
