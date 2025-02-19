<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'keigo',
            'mail' => 'keigo@co.jp',
            'age' => 28,
        ];
        DB::table('people')->insert($param);

        $param = [
            'name' => 'misato',
            'mail' => 'misato@co.jp',
            'age' => 27,
        ];
        DB::table('people')->insert($param);

        $param = [
            'name' => 'masaaki',
            'mail' => 'masaaki@co.jp',
            'age' => 63,
        ];
        DB::table('people')->insert($param);
    }
}
