<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('GroupsTableSeeders');
        $this->call('UserAdminSeeder');
        // $this->call('ProductSeeder');

        Model::reguard();
    }
}
