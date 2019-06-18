<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('members')->insert([
            [ 'name' => 'member_001' ],
            [ 'name' => 'member_002' ],
            [ 'name' => 'member_003' ],
            [ 'name' => 'member_004' ],
            [ 'name' => 'member_005' ],
            [ 'name' => 'member_006' ],
            [ 'name' => 'member_007' ],
            [ 'name' => 'member_008' ],
            [ 'name' => 'member_009' ],
            [ 'name' => 'member_010' ]
        ]);
    }
}