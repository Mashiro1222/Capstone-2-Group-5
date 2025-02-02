<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\UserAllergen;
use App\Models\Fruit;
use App\Models\Vegetable;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Retrieve the user's allergens
        $allergens = UserAllergen::where('user_id', $request->user()->id)->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'allergens' => $allergens, // Pass allergens to the view
        ]);
    }

    public function allergenSuggestions(Request $request)
    {
        $query = $request->input('query');
        $fruits = Fruit::where('name', 'LIKE', "%$query%")->get(['name']);
        $vegetables = Vegetable::where('name', 'LIKE', "%$query%")->get(['name']);

        $results = $fruits->merge($vegetables);

        return response()->json($results);
    }


    public function editAllergen($id)
    {
        $allergen = UserAllergen::find($id);

        if (!$allergen) {
            return redirect()->route('profile.edit')->withErrors([
                'error' => 'Allergen not found.',
            ]);
        }

        return view('profile.allergen-edit', ['allergen' => $allergen]);
    }

    public function updateAllergen(Request $request, $id)
    {
        $request->validate([
            'allergen_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('user_allergens', 'allergen_name')
                    ->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
                    ->ignore($id),
            ],
        ], [
            'allergen_name.unique' => "{$request->input('allergen_name')} is already in your allergens."
        ]);

        $allergen = Auth::user()->allergens()->findOrFail($id);
        $allergen->update([
            'allergen_name' => ucfirst(strtolower($request->input('allergen_name'))),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Allergen updated successfully!');
    }

    /**
     * Add a new allergen to the user's profile.
     */
    public function storeAllergen(Request $request)
    {
        $request->validate([
            'allergen_name' => 'required|string|max:255',
        ]);

        $allergenName = ucfirst(strtolower($request->input('allergen_name'))); // Normalize case

        // Check if the allergen already exists for the user
        $existingAllergen = Auth::user()->allergens()->where('allergen_name', $allergenName)->first();

        if ($existingAllergen) {
            return redirect()->route('profile.edit')->with('error', 'Allergen already exists.');
        }

        // Create the allergen
        Auth::user()->allergens()->create([
            'allergen_name' => $allergenName,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Allergen added successfully.');
    }


    /**
     * Delete an allergen from the user's profile.
     */
    public function deleteAllergen($id)
    {
        $allergen = UserAllergen::findOrFail($id);

        if ($allergen->user_id !== auth()->id()) {
            return redirect()->route('profile.edit')->with('error', 'You are not authorized to delete this allergen.');
        }

        $allergen->delete();

        return redirect()->route('profile.edit')->with('status', 'Allergen deleted successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
