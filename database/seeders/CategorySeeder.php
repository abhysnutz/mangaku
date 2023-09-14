<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['4 koma','Action','Adventure','Comedy','Cooking','Crime','Ction','Demons','Drama','Dventure','E Action','Ecchi','Fantasy','Game','Gender Bender','God Thief Agent','Harem','Historical','Horror','Isekai','Josei','Life','Magic','Manhua','Manhwa','Martial Arts','Mature','Mecha','Medical','Military','Music','Mystery','One Shot','Overpower','Parodi','Police','Psychological','Reincarnatio','Reincarnation','Romance','School','School life','Sci-f','Sci-fi','Seinen','Shotacon','Shoujo','Shoujo Ai','Shounen','Shounen Ai','Slice of Life','Sport','Sports','Super Power','Supernatural','Thriller','Tragedy','Urban','Vampire','Webtoons','Yuri'];
        
        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
                'slug' => \Str::slug($category)
            ]);
        }
    }
}
