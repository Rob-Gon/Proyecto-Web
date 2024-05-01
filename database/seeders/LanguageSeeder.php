<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lenguages = [
            ['language' => 'Alemán', 'flag' => 'german.png'],
            ['language' => 'Brazileño', 'flag' => 'brazilian.png'],
            ['language' => 'Chino', 'flag' => 'chinese.png'],
            ['language' => 'Coreano', 'flag' => 'korean.png'],
            ['language' => 'Español', 'flag' => 'spanish.png'],
            ['language' => 'Francés', 'flag' => 'french.png'],
            ['language' => 'Inglés UK', 'flag' => 'english_uk.png'],
            ['language' => 'Inglés US', 'flag' => 'english_us.png'],
            ['language' => 'Italiano', 'flag' => 'italian.png'],
            ['language' => 'Japonés', 'flag' => 'japanese.png'],
            ['language' => 'Polaco', 'flag' => 'polish.png'],
            ['language' => 'Portugués', 'flag' => 'portuguese.png'],
            ['language' => 'Ruso', 'flag' => 'russian.png'],
            ['language' => 'Serbio', 'flag' => 'serbian.png'],
            ['language' => 'Sueco', 'flag' => 'swedish.png'],
            ['language' => 'Suizo', 'flag' => 'swiss.png']
        ];

        foreach ($lenguages as $lenguage) {
            Language::create($lenguage);
        }
    }
}
