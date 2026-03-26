<?php

namespace Database\Seeders\ChartOfAccounts;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AccountGroupSeeder::class,
            GeneralLedgerSeeder::class,
            SubLedgerSeeder::class
        ]);
    }
}
