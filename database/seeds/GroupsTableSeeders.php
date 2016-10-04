<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Sentry::createGroup(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin' => 1,
            ),
        ));
    }
}
