<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    public function run()
    {
        DB::table('fruits')->insert([
            [
                'name' => 'Apple',
                'scientific_name' => 'Malus var. domestica',
                'description' => 'A commonly consumed fruit available in various varieties, used in cooking, baking, and fresh eating.',
                'possible_allergen' => 'Mal d 1 protein',
                'essential_information' => 'Cross-reactivity with birch, alder, and hazelnut pollen is common.',
                'symptoms' => 'Itching or swelling of the mouth, throat, and lips; gastrointestinal discomfort.',
            ],
            [
                'name' => 'Grapes',
                'scientific_name' => 'Vitis var. vinifera',
                'description' => 'A popular fruit used for eating fresh, making wine, and drying into raisins.',
                'possible_allergen' => 'Lipid transfer proteins (LTPs)',
                'essential_information' => 'Cross-reactivity may occur with other fruits like peaches and cherries.',
                'symptoms' => 'Skin rashes, hives, abdominal pain, or swelling.',
            ],
            [
                'name' => 'Mango',
                'scientific_name' => 'Mangifera var. indica',
                'description' => 'A tropical fruit with juicy, sweet flesh, often eaten fresh or used in smoothies, desserts, and sauces.',
                'possible_allergen' => 'Urushiol',
                'essential_information' => 'Cross-reactivity with poison ivy, poison oak, and cashew trees is possible.',
                'symptoms' => 'Skin irritation, itching, or rash upon contact; gastrointestinal symptoms if ingested.',
            ],
            [
                'name' => 'Orange',
                'scientific_name' => 'Citrus var. sinensis, reticulata',
                'description' => 'A widely consumed citrus fruit rich in vitamin C, often eaten fresh or juiced.',
                'possible_allergen' => 'Cit s 1 protein',
                'essential_information' => 'Cross-reactivity with other citrus fruits like lemons, limes, and grapefruits.',
                'symptoms' => 'Itching or swelling in the mouth, skin rashes, or respiratory symptoms.',
            ],
            [
                'name' => 'Tomato',
                'scientific_name' => 'Solanum var. lycopersicum',
                'description' => 'A versatile fruit used in salads, sauces, and as a base for many cooked dishes.',
                'possible_allergen' => 'Profilin and LTPs',
                'essential_information' => 'Cross-reactivity with other nightshades, such as potatoes, eggplant, and peppers.',
                'symptoms' => 'Oral itching, swelling of lips or tongue, or skin reactions.',
            ],
            [
                'name' => 'Watermelon',
                'scientific_name' => 'Citrullus var. lanatus',
                'description' => 'A juicy, sweet fruit with a high water content, popular in warm weather.',
                'possible_allergen' => 'Cuc m 1 protein',
                'essential_information' => 'Cross-reactivity with cucumber, zucchini, and other melons.',
                'symptoms' => 'Itching or swelling in the mouth, nausea, or diarrhea.',
            ],
            [
                'name' => 'Banana',
                'scientific_name' => 'Musa var. acuminata, balbisiana',
                'description' => 'A widely consumed fruit, often eaten as a snack or in smoothies and desserts.',
                'possible_allergen' => 'Banana profilins',
                'essential_information' => 'Cross-reactivity with latex, avocado, and kiwi.',
                'symptoms' => 'Itching or swelling of the mouth, throat, or lips; gastrointestinal distress.',
            ],
            [
                'name' => 'Kiwi',
                'scientific_name' => 'Actinidia var. deliciosa',
                'description' => 'A small, brown-skinned fruit with green flesh and tiny black seeds, known for its tangy flavor.',
                'possible_allergen' => 'Actinidin',
                'essential_information' => 'Cross-reactivity with latex, banana, and avocado.',
                'symptoms' => 'Severe itching or swelling in the mouth, throat, hives, or anaphylaxis.',
            ],
            [
                'name' => 'Strawberry',
                'scientific_name' => 'Fragaria var. ananassa',
                'description' => 'A bright red fruit with a sweet taste, often used in desserts and salads.',
                'possible_allergen' => 'Fra a 1 protein',
                'essential_information' => 'Cross-reactivity with birch pollen and apples.',
                'symptoms' => 'Oral itching, hives, swelling, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Peach',
                'scientific_name' => 'Prunus var. persica',
                'description' => 'A stone fruit with fuzzy skin, commonly eaten fresh or used in desserts like pies and cobblers.',
                'possible_allergen' => 'Pru p 3 LTP',
                'essential_information' => 'Cross-reactivity with birch pollen and other stone fruits like cherries and plums.',
                'symptoms' => 'Oral itching, swelling, skin rashes, or gastrointestinal distress.',
            ],
            [
                'name' => 'Pineapple',
                'scientific_name' => 'Ananas spp.',
                'description' => 'A tropical fruit with a rough, spiky skin and sweet, tangy flesh.',
                'possible_allergen' => 'Bromelain',
                'essential_information' => 'Cross-reactivity with latex and other tropical fruits is possible.',
                'symptoms' => 'Oral irritation, skin rash, nausea, or diarrhea.',
            ],
            [
                'name' => 'Papaya',
                'scientific_name' => 'Carica var. papaya',
                'description' => 'A tropical fruit with orange flesh, commonly used in smoothies and desserts.',
                'possible_allergen' => 'Papain',
                'essential_information' => 'Cross-reactivity with latex, kiwi, and avocado.',
                'symptoms' => 'Skin irritation, hives, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Avocado',
                'scientific_name' => 'Persea var. americana',
                'description' => 'A creamy-textured fruit used in dishes like guacamole and salads.',
                'possible_allergen' => 'Pers a 1 protein',
                'essential_information' => 'Cross-reactivity with latex, banana, and kiwi.',
                'symptoms' => 'Oral itching, swelling, hives, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Cherry',
                'scientific_name' => 'Prunus var. avium',
                'description' => 'A small, red stone fruit commonly eaten fresh or used in desserts like pies and tarts.',
                'possible_allergen' => 'Pru av 1 protein',
                'essential_information' => 'Cross-reactivity with birch pollen, apples, and other stone fruits.',
                'symptoms' => 'Oral itching, swelling, or skin reactions.',
            ],
            [
                'name' => 'Plum',
                'scientific_name' => 'Prunus var. domestica',
                'description' => 'A juicy stone fruit with smooth skin, often eaten fresh or dried into prunes.',
                'possible_allergen' => 'Pru d 1 protein',
                'essential_information' => 'Cross-reactivity with peaches, cherries, and other stone fruits.',
                'symptoms' => 'Oral itching, swelling, or gastrointestinal discomfort.',
            ],
            [
                'name' => 'Lemon',
                'scientific_name' => 'Citrus var. limon',
                'description' => 'A bright yellow citrus fruit known for its tart flavor, commonly used in beverages and cooking.',
                'possible_allergen' => 'Cit s 1 protein',
                'essential_information' => 'Cross-reactivity with other citrus fruits like limes, oranges, and grapefruits.',
                'symptoms' => 'Skin irritation, itching, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Durian',
                'scientific_name' => 'Durio spp.',
                'description' => 'A large tropical fruit known for its strong odor and custard-like flesh.',
                'possible_allergen' => 'Unknown',
                'essential_information' => 'Cross-reactivity with other fruits is not commonly reported.',
                'symptoms' => 'Skin rashes, respiratory issues, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Pomelo',
                'scientific_name' => 'Citrus var. maxima',
                'description' => 'A large citrus fruit with a thick rind and sweet, tangy flesh.',
                'possible_allergen' => 'Cit s 1 protein',
                'essential_information' => 'Cross-reactivity with other citrus fruits is possible.',
                'symptoms' => 'Skin irritation, itching, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Bilimbi',
                'scientific_name' => 'Averrhoa var. bilimbi',
                'description' => 'A sour, green fruit often used in cooking or pickling.',
                'possible_allergen' => 'Oxalic acid',
                'essential_information' => 'Cross-reactivity with star fruit is possible.',
                'symptoms' => 'Nausea, vomiting, or skin irritation in sensitive individuals.',
            ],
            [
                'name' => 'Calamansi',
                'scientific_name' => 'Citrus var. microcarpa',
                'description' => 'A small citrus fruit known for its tart flavor, often used in marinades, beverages, and various Filipino dishes.',
                'possible_allergen' => 'Cit s 1 protein',
                'essential_information' => 'Cross-reactivity with other citrus fruits like lemons, limes, and oranges is common.',
                'symptoms' => 'Skin irritation, itching, or gastrointestinal symptoms in sensitive individuals.',
            ],
        ]);
    }
}
