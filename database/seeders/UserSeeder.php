<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(10)
            ->create();

        $testerUser = new User(
            [
                'id' => '99999999-8888-7777-6666-555555555555',
                'name' => 'Tester',
                'email' => 'tester@jowett.me',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
        $testerUser->save();

        $testerTeam = new Team(
            [
                'name' => 'Tester\'s Team',
                'personal_team' => 1,
                'user_id' => '99999999-8888-7777-6666-555555555555',
            ]
        );
        $testerTeam->save();

        $testerUser->update(
            [
                'current_team_id' => $testerTeam->id,
            ]
        );
    }
}
