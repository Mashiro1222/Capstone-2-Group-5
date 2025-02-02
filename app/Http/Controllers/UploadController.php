<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Fruit;
use App\Models\Vegetable;
use App\Models\DetectionHistory;
use App\Models\UserAllergen;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imagePath = null;
        $fullImagePath = null;

        // Handle camera image (Base64) if provided
        if ($request->has('camera_image') && $request->filled('camera_image')) {
            $base64Image = $request->input('camera_image');

            if (str_contains($base64Image, ',')) {
                $imageData = explode(',', $base64Image)[1];
                $decodedImage = base64_decode($imageData);

                if (!$decodedImage) {
                    \Log::error('Failed to decode Base64 image data.');
                    return response()->json(['error' => 'Failed to decode Base64 image.'], 400);
                }

                $imagePath = 'images/' . Str::random(10) . '.jpg';
                $fullImagePath = public_path('storage/' . $imagePath);
                file_put_contents($fullImagePath, $decodedImage);
                \Log::info("Base64 image saved to: $fullImagePath");
            } else {
                \Log::error('Invalid Base64 image data structure.');
                return response()->json(['error' => 'Invalid Base64 image data.'], 400);
            }
        } elseif ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('images', 'public');
            $fullImagePath = public_path('storage/' . $imagePath);
            \Log::info("Uploaded image saved to: $fullImagePath");
        } else {
            return response()->json(['error' => 'No image provided.'], 400);
        }

        $resultImageName = 'result_' . Str::random(10) . '.jpg';
        $resultImagePath = 'storage/images/' . $resultImageName; // Save relative path
        $fullResultImagePath = public_path($resultImagePath);

        // Call Python script for processing
        $command = escapeshellcmd("python scripts/process_image.py "
            . escapeshellarg($fullImagePath)
            . ' ' . escapeshellarg($fullResultImagePath));
        $output = shell_exec($command);

        $result = json_decode($output, true);
        \Log::info('Raw Python script output: ' . $output);

        if (!$result || !isset($result['predictions'])) {
            \Log::error('No predictions found in the Python script output.');
            return response()->json(['error' => 'Failed to process the image.'], 400);
        }

        $matchedItems = [];
        $allergenWarnings = []; // Store allergens detected
        $userAllergens = UserAllergen::where('user_id', auth()->id())->pluck('allergen_name')->toArray();

        foreach ($result['predictions'] as $prediction) {
            $class = trim($prediction['class']);
            \Log::info("Detected class: $class");

            // Check for a match in Fruits
            $fruit = Fruit::where('name', $class)->first();
            if ($fruit) {
                $matchedItems[] = $this->prepareMatchedItem('Fruit', $fruit);
                $this->saveDetectionHistory($fruit, $resultImagePath);

                // Check if the detected fruit is a user allergen
                if (in_array($fruit->name, $userAllergens)) {
                    $allergenWarnings[] = $fruit->name;
                }
                continue;
            }

            // Check for a match in Vegetables
            $vegetable = Vegetable::where('name', $class)->first();
            if ($vegetable) {
                $matchedItems[] = $this->prepareMatchedItem('Vegetable', $vegetable);
                $this->saveDetectionHistory($vegetable, $resultImagePath);

                // Check if the detected vegetable is a user allergen
                if (in_array($vegetable->name, $userAllergens)) {
                    $allergenWarnings[] = $vegetable->name;
                }
            }
        }

        return view('result', [
            'result' => $result,
            'resultImagePath' => asset($resultImagePath),
            'matchedItems' => $matchedItems,
            'allergenWarnings' => $allergenWarnings, // Pass allergens to the result view
        ]);
    }

    /**
     * Save a detection history record.
     */
    private function saveDetectionHistory($item, $imagePath)
    {
        if (!$item) {
            \Log::error('Item is null, skipping history save.');
            return;
        }

        \Log::info("Saving detection history for: {$item->name}");

        DetectionHistory::create([
            'user_id' => auth()->id(),
            'item_name' => $item->name,
            'scientific_name' => $item->scientific_name,
            'description' => $item->description,
            'possible_allergen' => $item->possible_allergen,
            'symptoms' => $item->symptoms,
            'essential_information' => $item->essential_information,
            'image_path' => $imagePath, // Save the image path
        ]);

        \Log::info("Detection history saved successfully for: {$item->name}");
    }

    /**
     * Prepare matched item data for the result view.
     */
    private function prepareMatchedItem($type, $item)
    {
        return [
            'type' => $type,
            'name' => $item->name,
            'scientific_name' => $item->scientific_name,
            'description' => $item->description,
            'possible_allergen' => $item->possible_allergen,
            'essential_information' => $item->essential_information,
            'symptoms' => $item->symptoms,
        ];
    }

    public function getResult(Request $request)
    {
        // Get the detected name from the request
        $detectedName = $request->input('detected_name');

        // Ensure the user is authenticated
        $user = Auth::user();

        // Fetch user allergens (allergen_name column from the user_allergens table)
        $userAllergens = $user->allergens()->pluck('allergen_name')->toArray();

        // Check if the detected item is in the user's allergen list
        $isAllergen = in_array($detectedName, $userAllergens);

        // Return the response as JSON
        return response()->json([
            'detectedName' => $detectedName,
            'isAllergen' => $isAllergen,
        ]);
    }
}
