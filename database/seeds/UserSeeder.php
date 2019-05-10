<?php

use Illuminate\Database\Seeder;
use App\Fixtures\UserFixture as Fixture;
use App\Repositories\UserRepository as Users;

class UserSeeder extends Seeder
{
    public function __construct(Fixture $fixture, Users $users)
    {
        $this->fixture = $fixture;
        $this->users = $users;
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        collect($this->fixture->get())->each(function ($item) {
            $this->users->create($item);
        });
    }
}
