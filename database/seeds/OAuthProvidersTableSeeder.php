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
        DB::table('oauth_providers')->insert([
          'name' => 'google',
        ]);
    }
}
