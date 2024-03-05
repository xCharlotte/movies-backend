<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      \DB::table('oauth_clients')->insert([
        [
          'user_id' => null,
          'name' => 'Laravel Password Grant Client',
          'secret' => '4fwHCTdUhgajtCgGCR2DdCdF9z6G0xvaWxy6hgaB',
          'provider' => 'users',
          'redirect' => 'http://localhost',
          'personal_access_client' => 0,
          'password_client' => 1,
          'revoked' => 0,
        ],
        [
          'user_id' => null,
          'name' => 'Laravel Personal Access Client',
          'secret' => 'okixC2CeMDOPyuNXNjJj8nfSL7WV6zv6gByYJeV7',
          'provider' => null,
          'redirect' => 'http://localhost',
          'personal_access_client' => 1,
          'password_client' => 0,
          'revoked' => 0,
        ],
      ]);
    }
}
