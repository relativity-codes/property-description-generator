<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Services\OpenAIService;

class PropertyDescriptionController extends Controller
{
    /**
     * Store a new property and return an AI-generated description.
     */
    public function store(Request $request, OpenAIService $ai)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|in:House,Flat,Land,Commercial',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'key_features' => 'nullable|string',
        ]);

        $property = Property::create([
            'title' => $data['title'],
            'property_type' => $data['property_type'],
            'location' => $data['location'],
            'price' => $data['price'],
            'key_features' => $data['key_features'] ?? null,
        ]);

        $description = $ai->generateDescription([
            'title' => $property->title,
            'property_type' => $property->property_type,
            'location' => $property->location,
            'price' => $property->price,
            'key_features' => $property->key_features,
        ]);

        return response($description, 200);
    }

    /**
     * Regenerate an alternate description for an existing property.
     */
    public function regenerate(Request $request, OpenAIService $ai)
    {
        $data = $request->validate([
            'property_id' => 'required|integer|exists:properties,id',
        ]);

        $property = Property::findOrFail($data['property_id']);

        $description = $ai->generateDescription([
            'title' => $property->title,
            'property_type' => $property->property_type,
            'location' => $property->location,
            'price' => $property->price,
            'key_features' => $property->key_features,
        ], ['alternate' => true]);

        return response($description, 200);
    }
}