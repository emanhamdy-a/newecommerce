<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $owner =Admin::create([
        'id' => 1,
        'name' => 'Eman Hamdy',
        'email' => 'eman@example.com',
        // 'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        ]);

    $users = factory('App\User', 30)->create();
    $users = factory('App\Admin', 10)->create();
  }
}
