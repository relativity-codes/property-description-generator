<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed the properties table with initial data
        Property::create([
            'title' => 'Luxury 3-Bedroom Apartment',
            'type' => 'Flat',
            'location' => 'Victoria Island, Lagos',
            'price' => 15000000,
            'features' => 'Swimming pool, Gym, 24/7 security, Close to the beach',
        ]);

        Property::create([
            'title' => 'Spacious Family House',
            'type' => 'House',
            'location' => 'Lekki, Lagos',
            'price' => 25000000,
            'features' => 'Large garden, 5 bedrooms, Modern kitchen, Parking space',
        ]);

        Property::create([
            'title' => 'Commercial Land for Sale',
            'type' => 'Land',
            'location' => 'Ikeja, Lagos',
            'price' => 30000000,
            'features' => 'Prime location, Accessible roads, Suitable for various businesses',
        ]);
    }
}