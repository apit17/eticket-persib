<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        \DB::table('users_groups')->truncate();
        // Create the user
        $user = Sentry::createUser(array(
            'email'     => 'admin@eticket.com',
            'password'  => 'qwerty',
            'activated' => true,
            'first_name' => 'Admin',
            'last_name' => 'Eticket',
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);

        // Assign the group to the user
        $user->addGroup($adminGroup);
    }
}
