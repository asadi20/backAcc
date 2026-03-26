<?php

namespace Database\Seeders\ChartOfAccounts;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Account Group Seeder
        DB::table('chart_of_accounts')->upsert(
            [
                ['code' => '1', 'name' => 'دارایی های جاری', 'level' => 0, 'parent_id' => null],
                ['code' => '2', 'name' => 'دارایی های غیرجاری', 'level' => 0, 'parent_id' => null],
                ['code' => '3', 'name' => 'بدهی های جاری', 'level' => 0, 'parent_id' => null],
                ['code' => '4', 'name' => 'بدهی های غیرجاری', 'level' => 0, 'parent_id' => null],
                ['code' => '5', 'name' => 'حقوق صاحبان سهام', 'level' => 0, 'parent_id' => null],
                ['code' => '6', 'name' => 'هزینه های', 'level' => 0, 'parent_id' => null],
                ['code' => '7', 'name' => 'فروش و درآمدها', 'level' => 0, 'parent_id' => null],
                ['code' => '8', 'name' => 'بهای تمام شده', 'level' => 0, 'parent_id' => null],
                ['code' => '9', 'name' => 'حسابهای انتظامی', 'level' => 0, 'parent_id' => null],
            ],
            ['code'], // unique by
            ['name', 'level', 'parent_id'] // update
        );
    }
}
