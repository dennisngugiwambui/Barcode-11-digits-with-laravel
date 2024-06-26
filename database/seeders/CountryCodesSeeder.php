<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\CountryCode;

class CountryCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name' => 'Algeria', 'code' => '213'],
            ['name' => 'Angola', 'code' => '244'],
            ['name' => 'Benin', 'code' => '229'],
            ['name' => 'Botswana', 'code' => '267'],
            ['name' => 'Burkina Faso', 'code' => '226'],
            ['name' => 'Burundi', 'code' => '257'],
            ['name' => 'Cabo Verde', 'code' => '238'],
            ['name' => 'Cameroon', 'code' => '237'],
            ['name' => 'Central African Republic', 'code' => '236'],
            ['name' => 'Chad', 'code' => '235'],
            ['name' => 'Comoros', 'code' => '269'],
            ['name' => 'Democratic Republic of the Congo', 'code' => '243'],
            ['name' => 'Djibouti', 'code' => '253'],
            ['name' => 'Egypt', 'code' => '20'],
            ['name' => 'Equatorial Guinea', 'code' => '240'],
            ['name' => 'Eritrea', 'code' => '291'],
            ['name' => 'Eswatini', 'code' => '268'],
            ['name' => 'Ethiopia', 'code' => '251'],
            ['name' => 'Gabon', 'code' => '241'],
            ['name' => 'Gambia', 'code' => '220'],
            ['name' => 'Ghana', 'code' => '233'],
            ['name' => 'Guinea', 'code' => '224'],
            ['name' => 'Guinea-Bissau', 'code' => '245'],
            ['name' => 'Ivory Coast', 'code' => '225'],
            ['name' => 'Kenya', 'code' => '254'],
            ['name' => 'Lesotho', 'code' => '266'],
            ['name' => 'Liberia', 'code' => '231'],
            ['name' => 'Libya', 'code' => '218'],
            ['name' => 'Madagascar', 'code' => '261'],
            ['name' => 'Malawi', 'code' => '265'],
            ['name' => 'Mali', 'code' => '223'],
            ['name' => 'Mauritania', 'code' => '222'],
            ['name' => 'Mauritius', 'code' => '230'],
            ['name' => 'Morocco', 'code' => '212'],
            ['name' => 'Mozambique', 'code' => '258'],
            ['name' => 'Namibia', 'code' => '264'],
            ['name' => 'Niger', 'code' => '227'],
            ['name' => 'Nigeria', 'code' => '234'],
            ['name' => 'Republic of the Congo', 'code' => '242'],
            ['name' => 'Rwanda', 'code' => '250'],
            ['name' => 'São Tomé and Príncipe', 'code' => '239'],
            ['name' => 'Senegal', 'code' => '221'],
            ['name' => 'Seychelles', 'code' => '248'],
            ['name' => 'Sierra Leone', 'code' => '232'],
            ['name' => 'Somalia', 'code' => '252'],
            ['name' => 'South Africa', 'code' => '27'],
            ['name' => 'South Sudan', 'code' => '211'],
            ['name' => 'Sudan', 'code' => '249'],
            ['name' => 'Tanzania', 'code' => '255'],
            ['name' => 'Togo', 'code' => '228'],
            ['name' => 'Tunisia', 'code' => '216'],
            ['name' => 'Uganda', 'code' => '256'],
            ['name' => 'Zambia', 'code' => '260'],
            ['name' => 'Zimbabwe', 'code' => '263'],
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
