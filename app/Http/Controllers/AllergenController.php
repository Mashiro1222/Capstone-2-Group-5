<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAllergen;

class AllergenController extends Controller
{
    public function edit($id)
    {
        $allergen = UserAllergen::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('profile.allergen-edit', [
            'allergen' => $allergen,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'allergen_name' => 'required|string|max:255',
        ]);

        $allergen = UserAllergen::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $allergen->update(['allergen_name' => $request->allergen_name]);

        return redirect()->route('profile.edit')->with('status', 'Allergen updated successfully.');
    }
}
