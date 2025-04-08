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
        $detectedClasses = []; // Initialize detectedClasses as an empty array
        $matchedItems = []; // Ensure matchedItems is initialized
        $allergenWarnings = [];
        $detectedClasses = []; // Initialize detectedClasses as an empty array

    
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
    
                $imageName = Str::random(10) . '.jpg';
                $imagePath = 'images/' . $imageName;
                $fullImagePath = storage_path('app/public/' . $imagePath);
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
    
            $imageName = Str::random(10) . '.' . $request->file('image')->extension();
            $imagePath = 'images/' . $imageName;
            $fullImagePath = base_path('storage/app/public/' . $imagePath);
    
            $request->file('image')->move(base_path('storage/app/public/images'), $imageName);
            \Log::info("Uploaded image saved to: $fullImagePath");
        } else {
            return response()->json(['error' => 'No image provided.'], 400);
        }
    
        // Call Flask API for processing
        $flaskApiUrl = 'http://3.106.122.99:5000/detect';
        $ch = curl_init();
        $data = [
            'image' => new \CURLFile($fullImagePath)
        ];
    
        curl_setopt($ch, CURLOPT_URL, $flaskApiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpCode !== 200) {
            \Log::error('Flask API Error: ' . $response);
            return response()->json(['error' => 'Failed to process the image.'], $httpCode);
        }
    
        $result = json_decode($response, true);
    
        // Validate and extract predictions
        if (!is_array($result) || !isset($result['predictions']) || !isset($result['predictions']['predictions'])) {
            \Log::error('Invalid response format: ' . json_encode($result));
            return response()->json(['error' => 'Failed to process the image.'], 400);
        }
    
        $predictions = $result['predictions']['predictions'];
        $matchedItems = [];
        $allergenWarnings = [];
        $userAllergens = UserAllergen::where('user_id', auth()->id())->pluck('allergen_name')->toArray();
    
        foreach ($predictions as $prediction) {
            if (isset($prediction['class'])) {
                $class = trim($prediction['class']);
                \Log::info("Detected class: $class");
                $detectedClasses[] = $class; // Add to the detectedClasses array

    
                // Check for a match in Fruits
                $fruit = Fruit::where('name', $class)->first();
                if ($fruit) {
                    $matchedItems[] = $this->prepareMatchedItem('Fruit', $fruit);
                    $this->saveDetectionHistory($fruit, $imagePath);
    
                    if (in_array($fruit->name, $userAllergens)) {
                        $allergenWarnings[] = $fruit->name;
                    }
                    continue;
                }
    
                // Check for a match in Vegetables
                $vegetable = Vegetable::where('name', $class)->first();
                if ($vegetable) {
                    $matchedItems[] = $this->prepareMatchedItem('Vegetable', $vegetable);
                    $this->saveDetectionHistory($vegetable, $imagePath);
    
                    if (in_array($vegetable->name, $userAllergens)) {
                        $allergenWarnings[] = $vegetable->name;
                    }
                }
            } else {
                \Log::warning("Invalid prediction format: " . json_encode($prediction));
            }
            
            if (isset($prediction['class'])) {
    $class = trim($prediction['class']);
    \Log::info("Detected class: $class"); // For debugging
    $detectedClasses[] = $class; // Add to the detectedClasses array
}

        }
        $detectedClasses = array_unique($detectedClasses); // Ensure no duplicates
    
        return view('result', [
            'result' => $result,
            'resultImagePath' => asset('storage/' . $imagePath),
            'matchedItems' => $matchedItems,
            'allergenWarnings' => $allergenWarnings,
            'detectedClasses' => $detectedClasses,
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
        
        $publicImagePath = 'storage/' . $imagePath;

        DetectionHistory::create([
            'user_id' => auth()->id(),
            'item_name' => $item->name,
            'scientific_name' => $item->scientific_name,
            'description' => $item->description,
            'possible_allergen' => $item->possible_allergen,
            'symptoms' => $item->symptoms,
            'essential_information' => $item->essential_information,
            'image_path' => $publicImagePath, // Save the image path
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
    public function addAllergen(Request $request)
{
    $request->validate([
        'name' => 'required|string',
    ]);

    try {
        $allergenName = $request->input('name');

        // Check if the allergen already exists for the user
        $existingAllergen = \App\Models\UserAllergen::where('user_id', auth()->id())
            ->where('allergen_name', $allergenName)
            ->first();

        if ($existingAllergen) {
            return response()->json([
                'success' => false,
                'message' => "This {$allergenName} is already added in your allergen profile."
            ]);
        }

        // Add the allergen to the database
        \App\Models\UserAllergen::create([
            'user_id' => auth()->id(),
            'allergen_name' => $allergenName,
        ]);

        return response()->json([
            'success' => true,
            'message' => "{$allergenName} has been successfully added to your allergen profile."
        ]);
    } catch (\Exception $e) {
        \Log::error('Error adding allergen: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while adding the allergen.'
        ], 500);
    }
}

}
