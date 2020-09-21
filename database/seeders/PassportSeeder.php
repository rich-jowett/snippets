<?php

namespace Database\Seeders;

use Faker\Provider\Uuid;
use Firebase\JWT\JWT;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientId = '00000000-1111-2222-3333-444444444444';
        $userId = '99999999-8888-7777-6666-555555555555';
        $issuedAt = new \DateTime('1st January 2020', new \DateTimeZone('UTC'));
        $expiresAt = new \DateTime('1st January 2023', new \DateTimeZone('UTC'));

        DB::table('oauth_clients')
            ->insertOrIgnore(
                [
                    'id' => $clientId,
                    'name' => 'Seeder Client',
                    'secret' => bcrypt('oauth-secret'),
                    'redirect' => config('app.url') . '/redirect',
                    'personal_access_client' => 0,
                    'password_client' => 0,
                    'revoked' => 0,
                    'created_at' => $issuedAt,
                    'updated_at' => $issuedAt,
                ]
            );

        DB::table('oauth_access_tokens')
            ->insertOrIgnore(
                [
                    'id' => 'tester-token',
                    'client_id' => $clientId,
                    'user_id' => $userId,
                    'expires_at' => $expiresAt,
                    'revoked' => 0,
                    'scopes' => '[]',
                    'created_at' => $issuedAt,
                    'updated_at' => $issuedAt,
                ]
            );

        if (file_exists(__DIR__. '/../../storage/oauth-private.key')) {
            printf(
                "Your test Access Token is: %s\n",
                JWT::encode(
                    [
                        "aud" => $clientId,
                        "jti" => "tester-token",
                        "iat" => $issuedAt->getTimestamp(),
                        "nbf" => $issuedAt->getTimestamp(),
                        "exp" => $expiresAt->getTimestamp(),
                        "sub" => $userId,
                        "scopes" => []
                    ],
                    file_get_contents(__DIR__. '/../../storage/oauth-private.key'),
                    'RS256'
                )
            );
        }
    }
}
