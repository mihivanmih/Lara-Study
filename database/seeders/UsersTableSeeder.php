<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@g.g',
                'password' => Hash::make(Str::Random(16)),
            ],
            [
                'name' => 'Автор',
                'email' => 'author@g.g',
                'password' => Hash::make(Str::Random(123123)),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
