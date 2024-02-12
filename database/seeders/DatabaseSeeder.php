<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        Storage::deleteDirectory('public/images/postImage');
        Storage::deleteDirectory('public/images/tmp');


        $user = \App\Models\User::factory()->create([
            'username' => 'Galeria'
        ]);

        $images = Storage::allFiles('images/seeder');
        $imageNames = [];

        foreach ($images as $image) {
        //    dd(pathinfo($image)['extension']);
            $imageNames[] = basename($image);
        }

        foreach(range(1, 100) as $index) {
            $post = \App\Models\Post::factory()->create([
                'title' => 'test post',
                'description' => 'lorem ipsum',
                'user_id' => $user->id,
            ]);

            foreach(range(1, 2) as $commentindex) {
                \App\Models\Comment::factory()->create([
                    'comment' => 'lorem ipsum comment',
                    'user_id' => $user->id,
                    'post_id' => $post->id
                ]);
            }
            
            $chosenImage = $imageNames[array_rand($imageNames)];
            $newPath = uniqid('folder-', true). '/'. uniqid('image-', true)  . pathinfo($chosenImage)['extension'];
           
            Storage::copy('images/seeder/'. $chosenImage, 'public/images/postImage/' . $newPath);
            \App\Models\Post_image::factory()->create([
                'image' => $newPath,
                'post_id' => $post->id,
            ]);
        }

        $album = \App\Models\Album::factory()->create([
            'title' => 'test album',
            'user_id' => $user->id,
        ]);

        

        $album->posts()->attach($post);

        \App\Models\Like::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $admin = \App\Models\User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);

        Role::create(['name' => 'admin']);

        $admin->assignRole('admin');        
    }
}
