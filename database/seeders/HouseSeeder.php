<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Delete existing images in the storage directory
        Storage::disk('public')->deleteDirectory('houses');

        foreach (range(1, 10) as $index) {
            //generate a fake title using faker
            $title = Factory::create()->text(20);

            $slug = Str::slug($title);
            $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

            $status = ['not available', 'available', 'sold'][rand(0, 2)];
            $type = ['rent', 'sale'][rand(0, 1)];
            $bedrooms = rand(1, 5);
            $bathrooms = rand(1, 3);
            $sqm = rand(50, 200);
            $userId = rand(1, 10);
            $image = $this->getRandomImage();

            DB::table('houses')->insert([
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'status' => $status,
                'type' => $type,
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
                'sqm' => $sqm,
                'user_id' => $userId,
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Get a random image URL from the array of image URLs.
     *
     * @return string
     */
    private function getRandomImage(){
        $images = [
            'https://source.unsplash.com/random/800x600/?img=1',
            'https://source.unsplash.com/random/200x200/?img=2',
            'https://source.unsplash.com/random/200x200/?img=3',
            'https://source.unsplash.com/random/200x200/?img=4',
        ];

        return $images[rand(0, count($images) - 1)];
    }
}
