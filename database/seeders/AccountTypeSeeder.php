<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accounting\AccountType;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_types')->truncate();

        $data = [
            [
                'slug'=>'ASSET',
                'name'=>'دارایی',
                'sign'=>1,
                'display_order'=>1,
                'description'=>'حسابهای مربوط به دارایی های جاری و غیرجاری'
            ],
            [
                'slug'=>'LIABILITY',
                'name'=>'بدهی',
                'sign'=>-1,
                'display_order'=>2,
                'description'=>'حسابهای مربوط به بدهی های جاری و غیرجاری'
            ],
            [
                'slug'=>'EQUITY',
                'name'=>'حقوق صاحبان سرمایه',
                'sign'=>-1,
                'display_order'=>3,
                'description'=>'سرمایه و سود و زیان انباشه'
            ],
            [
                'slug'=>'REVENUE',
                'name'=>'درآمد',
                'sign'=>1,
                'display_order'=>4,
                'description'=>'درآمدهای عملیاتی و غیرعملیاتی'
            ],
            [
                'slug'=>'EXPENSE',
                'name'=>'هزینه',
                'sign'=>-1,
                'display_order'=>5,
                'description'=>'هزینه های عملیاتی و غیرعملیاتی'
            ],

        ];

        DB::table('account_types')->insert($data);
        $this->command->info('account types inserted successfully');
        
    }
}
