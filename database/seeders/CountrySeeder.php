<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CountryCode;
use Illuminate\Support\Facades\Log; // Import the Log facade

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name' => 'Algeria', 'code' => '213'],
            ['name' => 'Angola', 'code' => '244'],
            // Add more countries here
        ];

        foreach ($countries as $country) {
            Log::info("Seeding country: {$country['name']} ({$country['code']})");
            CountryCode::create([
                'countryName' => $country['name'],
                'countryCode' => $country['code'],
            ]);
        }
    }
}
