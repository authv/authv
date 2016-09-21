<?php

use Illuminate\Database\Seeder;

class OAuthProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = [
          ['name' => 'google'],
          ['name' => 'facebook'],
          ['name' => 'twitter'],
          ['name' => 'github'],
        ];
        DB::table('oauth_providers')->insert($providers);
    }
}
