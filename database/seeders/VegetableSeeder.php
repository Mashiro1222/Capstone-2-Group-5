<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VegetableSeeder extends Seeder
{
    public function run()
    {
        DB::table('vegetables')->insert([
            [
                'name' => 'Bitter Melon',
                'scientific_name' => 'Momordica var. charantia',
                'description' => 'A bitter vegetable used in Asian cuisine, particularly in stir-fries and soups.',
                'possible_allergen' => 'Cucurbitacin',
                'essential_information' => 'Cross-reactivity with other members of the cucurbit family, such as squash and cucumber, is uncommon.',
                'symptoms' => 'Mild gastrointestinal discomfort, itching, or skin irritation.',
            ],
            [
                'name' => 'Cabbage',
                'scientific_name' => 'Brassica var. oleracea',
                'description' => 'A leafy green vegetable used in salads, slaws, and cooked dishes.',
                'possible_allergen' => 'Brassica proteins',
                'essential_information' => 'Cross-reactivity with other cruciferous vegetables, such as broccoli, cauliflower, and Brussels sprouts, is possible.',
                'symptoms' => 'Gastrointestinal upset, skin rashes, or respiratory symptoms.',
            ],
            [
                'name' => 'Carrots',
                'scientific_name' => 'Daucus var. carota',
                'description' => 'A root vegetable, often consumed raw, cooked, or juiced.',
                'possible_allergen' => 'Dau c 1 protein',
                'essential_information' => 'Cross-reactivity with celery and other root vegetables like parsnips.',
                'symptoms' => 'Oral itching, swelling of the lips, throat discomfort, or gastrointestinal symptoms.',
            ],
            [
                'name' => 'Celery',
                'scientific_name' => 'Apium var. graveolens',
                'description' => 'A crunchy, green vegetable used in salads and soups.',
                'possible_allergen' => 'Api g 1 protein',
                'essential_information' => 'Cross-reactivity with carrots, parsley, and birch pollen is common.',
                'symptoms' => 'Hives, swelling, gastrointestinal distress, or anaphylaxis.',
            ],
            [
                'name' => 'Onion',
                'scientific_name' => 'Allium var. cepa, ascalonicum, schoenoprasum',
                'description' => 'A bulbous vegetable used as a base in many culinary dishes.',
                'possible_allergen' => 'Alliinase enzyme',
                'essential_information' => 'Cross-reactivity with garlic, leeks, and other members of the Allium family.',
                'symptoms' => 'Respiratory symptoms, skin rashes, or gastrointestinal upset.',
            ],
            [
                'name' => 'Potato',
                'scientific_name' => 'Solanum var. tuberosum',
                'description' => 'A starchy tuber commonly used in various dishes worldwide.',
                'possible_allergen' => 'Sol t 1 protein',
                'essential_information' => 'Cross-reactivity with other nightshades, such as tomatoes and eggplants, is common.',
                'symptoms' => 'Skin rashes, itching, or gastrointestinal discomfort.',
            ],
            [
                'name' => 'Bottle Gourd',
                'scientific_name' => 'Lagenaria siceraria',
                'description' => 'A vine-grown fruit used as a vegetable, container, or musical instrument.',
                'possible_allergen' => 'Cucurbitacins',
                'essential_information' => 'Cross-reactivity with other cucurbitaceae family members like cucumbers, melons, and squash is possible.',
                'symptoms' => 'Itching of the mouth or throat, swelling of lips, tongue, face, or neck, hives/rashes on skin, vomiting/nausea, and abdominal pain.',
            ],
            [
                'name' => 'String Beans',
                'scientific_name' => 'Phaseolus vulgaris',
                'description' => 'A long, slender legume commonly used in stir-fries and stews.',
                'possible_allergen' => 'Legume proteins',
                'essential_information' => 'Cross-reactivity with peanuts, soybeans, and other legumes is possible.',
                'symptoms' => 'Hives, gastrointestinal upset, or respiratory symptoms.',
            ],
            [
                'name' => 'Peanuts',
                'scientific_name' => 'Arachis var. hypogaea',
                'description' => 'A legume consumed as a snack, in spreads, or as an ingredient in various dishes.',
                'possible_allergen' => 'Ara h 1, Ara h 2, and Ara h 3 proteins',
                'essential_information' => 'Cross-reactivity with other legumes, such as soybeans and peas, is possible.',
                'symptoms' => 'Hives, swelling, gastrointestinal distress, or anaphylaxis.',
            ],
            [
                'name' => 'Lima Beans',
                'scientific_name' => 'Phaseolus var. lunatus',
                'description' => 'A legume used in soups, stews, and side dishes.',
                'possible_allergen' => 'Legume proteins',
                'essential_information' => 'Cross-reactivity with peanuts and soybeans is possible.',
                'symptoms' => 'Hives, gastrointestinal upset, or respiratory symptoms.',
            ],
            [
                'name' => 'Mustard Green',
                'scientific_name' => 'Brassica var. juncea',
                'description' => 'A leafy vegetable with a sharp, peppery flavor, used in salads and stir-fries.',
                'possible_allergen' => 'Sin a 1 protein',
                'essential_information' => 'Cross-reactivity with other cruciferous vegetables like broccoli and cabbage.',
                'symptoms' => 'Gastrointestinal upset, hives, or respiratory symptoms.',
            ],
            [
                'name' => 'Eggplant',
                'scientific_name' => 'Solanum var. melongena',
                'description' => 'A common vegetable in various dishes, with a purple or white exterior.',
                'possible_allergen' => 'Solanine and histamine',
                'essential_information' => 'Cross-reactivity with other nightshades, such as tomatoes and potatoes, is possible.',
                'symptoms' => 'Itching, swelling, hives, or gastrointestinal discomfort.',
            ],
            [
                'name' => 'Squash',
                'scientific_name' => 'Cucurbita var. pepo, maxima',
                'description' => 'A versatile vegetable that comes in many forms, including pumpkins and zucchinis.',
                'possible_allergen' => 'Cucurbitacins',
                'essential_information' => 'People with ragweed allergies may experience cross-reactivity, leading to oral allergy syndrome (OAS).',
                'symptoms' => 'Itching, swelling, or gastrointestinal upset.',
            ],
            [
                'name' => 'Garlic',
                'scientific_name' => 'Allium var. sativum',
                'description' => 'A widely used spice with a pungent flavor, essential in global cuisines.',
                'possible_allergen' => 'Alliin lyase enzyme',
                'essential_information' => 'Cross-reactivity with other members of the Allium family, like onions and leeks.',
                'symptoms' => 'Skin rashes, respiratory symptoms, or gastrointestinal distress.',
            ],
            [
                'name' => 'Hyacinth Beans',
                'scientific_name' => 'Lablab var. purpureus',
                'description' => 'A climbing plant with edible pods, commonly used in South and Southeast Asian dishes.',
                'possible_allergen' => 'Legume proteins',
                'essential_information' => 'Possible cross-reactivity with peanuts and soybeans due to shared legume proteins.',
                'symptoms' => 'Hives, gastrointestinal upset, or respiratory symptoms.',
            ],
            [
                'name' => 'Ribbed Gourd',
                'scientific_name' => 'Luffa var. acutangula',
                'description' => 'A ridged gourd used in Asian cuisines, particularly in soups.',
                'possible_allergen' => 'Unknown',
                'essential_information' => 'Cross-reactivity with other gourds is unlikely.',
                'symptoms' => 'Mild itching or skin irritation.',
            ],
            [
                'name' => 'Cucumber',
                'scientific_name' => 'Cucumis var. sativus',
                'description' => 'A widely cultivated vegetable with a crisp texture, commonly used in salads and sandwiches.',
                'possible_allergen' => 'Cucurbitacins',
                'essential_information' => 'Cross-reactivity with other cucurbits like squash and melon is possible.',
                'symptoms' => 'Skin irritation, itching, or gastrointestinal discomfort.',
            ],
            [
                'name' => 'Ladies’ Fingers',
                'scientific_name' => 'Abelmoschus esculentus',
                'description' => 'A green vegetable known for its edible pods, commonly used in soups and stews.',
                'possible_allergen' => 'Okra proteins',
                'essential_information' => 'Cross-reactivity with other members of the Malvaceae family is possible.',
                'symptoms' => 'Skin irritation, itching, or gastrointestinal discomfort.',
            ],
            [
                'name' => 'Winged Beans',
                'scientific_name' => 'Psophocarpus tetragonolobus',
                'description' => 'A tropical legume known for its edible pods, seeds, and leaves, often used in stir-fries.',
                'possible_allergen' => 'Legume proteins',
                'essential_information' => 'Cross-reactivity with peanuts and soybeans is possible.',
                'symptoms' => 'Hives, swelling, or gastrointestinal symptoms in those with legume allergies.',
            ],
        ]);
    }
}
