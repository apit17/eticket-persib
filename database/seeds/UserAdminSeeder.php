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
        // Create the user
        $user = Sentry::createUser(array(
            'email'     => 'admin@kissproof.com',
            'password'  => '01012015',
            'activated' => true,
            'first_name' => 'Ilma',
            'last_name' => 'Rizki',
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);

        // Assign the group to the user
        $user->addGroup($adminGroup);
    }
}
