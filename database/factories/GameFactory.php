<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulos = [
            'The Legend of Zelda: Breath of the Wild',
            'Elden Ring',
            'God of War Ragnarok',
            'Red Dead Redemption 2',
            'Cyberpunk 2077',
            'Hollow Knight',
            'Super Mario Odyssey',
            'The Witcher 3: Wild Hunt',
            'Dark Souls III',
            'Final Fantasy VII Remake',
            'The Last of Us Part I',
            'Bloodborne',
            'Persona 5',
            'Sekiro: Shadows Die Twice',
            'Monster Hunter: World',
            'Death Stranding',
            'Resident Evil Village',
            'Ghost of Tsushima',
            'Nier: Automata',
            'Horizon Zero Dawn',
            'Total War: Warhammer III',
            'Total War: Dynasties',
            'EA Sports FC 25',
            'Fornite',
            'League of Legends',
            'Minecraft',
            'Valorant',
            'DotA 2',
            'PUBG: Battlegrounds',
            'Path of Exile 2',
            'Diablo IV',
        ];

        return [
            'name' => $this->faker->randomElement($titulos),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'developer' => $this->faker->company,
            'release_date' => $this->faker->date(),
            'trailer_url' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'rating' => $this->faker->randomFloat(1, 0, 10),
            'platform' => $this->faker->randomElement(['pc', 'ps4', 'xbox']),
            'genre' => $this->faker->randomElement(['action', 'adventure', 'rpg', 'strategy', 'sports']),
        ];
    }
}
