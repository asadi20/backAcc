<?php

namespace Database\Seeders\ChartOfAccounts;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentAssetId = DB::table('chart_of_accounts')->where('code', 1)->value('id');
        $nonCurrentAssetId = DB::table('chart_of_accounts')->where('code', 2)->value('id');
        $currentLiabilityId = DB::table('chart_of_accounts')->where('code', 3)->value('id');
        $nonCurrentLiabilityId = DB::table('chart_of_accounts')->where('code', 4)->value('id');
        $equityId = DB::table('chart_of_accounts')->where('code', 5)->value('id');
        $expenseId = DB::table('chart_of_accounts')->where('code', 6)->value('id');
        $revenueId = DB::table('chart_of_accounts')->where('code', 7)->value('id');
        $costId = DB::table('chart_of_accounts')->where('code', 8)->value('id');
        $controlId = DB::table('chart_of_accounts')->where('code', 9)->value('id');


        // insert group of accounts
        DB::table('chart_of_accounts')->upsert(
            [
                // currentAsset
                ['code' => '110', 'name' => 'موجودی نقد و بانک', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '111', 'name' => 'سرمایه گذاری های کوتاه مدت', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '112', 'name' => 'حساب ها و اسناد دریافتنی تجاری', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '113', 'name' => 'سایر حساب ها و اسناد دریافتنی', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '114', 'name' => 'موجودی مواد و کالا', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '115', 'name' => 'سفارشات و پیش پرداخت ها', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '116', 'name' => 'سپرده های ما نزد دیگران', 'level' =>1 , 'parent_id'=> $currentAssetId],
                ['code' => '121', 'name' => 'تسهیلات واحد اعتباری', 'level' =>1 , 'parent_id'=> $currentAssetId],

                // nonCurrentAsset
                ['code' => '211', 'name' => 'داراییهای ثابت مشهود', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],
                ['code' => '212', 'name' => 'استهلاک انباشته داراییهای ثابت مشهود', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],
                ['code' => '213', 'name' => 'داراییهای نامشهود', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],
                ['code' => '214', 'name' => 'سرمایه گذاری بلند مدت', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],
                ['code' => '215', 'name' => 'دارائیهای در جریان تکمیل', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],
                ['code' => '216', 'name' => 'سایر داراییهای', 'level' =>1 , 'parent_id'=> $nonCurrentAssetId],

                // currentLiability
                ['code' => '311', 'name' => 'حساب هاو اسناد پرداختنی تجاری', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '312', 'name' => 'سایر حساب هاو اسناد پرداختنی', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '315', 'name' => 'سفارشات و پیش دریافت ها', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '316', 'name' => 'تسهیلات و اعتبارات مالی دریافتی کوتاه مدت', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '318', 'name' => 'سود سهام پیشنهادی و پرداختنی', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '320', 'name' => 'ذخیره مالیات', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '321', 'name' => 'سپرده های واحد اعتباری', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '322', 'name' => 'رابط فروشگاه ها', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '323', 'name' => 'ذخایر', 'level' =>1 , 'parent_id'=> $currentLiabilityId],
                ['code' => '324', 'name' => 'سپرده های پرداختنی', 'level' =>1 , 'parent_id'=> $currentLiabilityId],

                // nonCurrentLiability
                ['code' => '411', 'name' => 'حسابها و اسناد پرداختنی بلند مدت  تجاری', 'level' =>1 , 'parent_id'=> $nonCurrentLiabilityId],
                ['code' => '412', 'name' => 'تسهیلات و اعتبارات مالی دریافتی بلند مدت', 'level' =>1 , 'parent_id'=> $nonCurrentLiabilityId],
                ['code' => '413', 'name' => 'درآمدهای انتقالی به دوره های آتی', 'level' =>1 , 'parent_id'=> $nonCurrentLiabilityId],
                ['code' => '414', 'name' => 'ذخیره مزایای پایان خدمت کارکنان', 'level' =>1 , 'parent_id'=> $nonCurrentLiabilityId],
                ['code' => '415', 'name' => 'سایر حسابها و اسناد دریافتنی بلند مدت', 'level' =>1 , 'parent_id'=> $nonCurrentLiabilityId],

                // equity
                ['code' => '511', 'name' => 'سرمایه پرداخت شده', 'level' =>1 , 'parent_id'=> $equityId],
                ['code' => '512', 'name' => 'اندوخته قانونی', 'level' =>1 , 'parent_id'=> $equityId],
                ['code' => '513', 'name' => 'سایر ذخایر', 'level' =>1 , 'parent_id'=> $equityId],
                ['code' => '514', 'name' => 'مازاد تجدید ارزیابی دارایی های ثابت مشهود', 'level' =>1 , 'parent_id'=> $equityId],
                ['code' => '516', 'name' => 'سود و زیان', 'level' =>1 , 'parent_id'=> $equityId],

                // expense
                ['code' => '610', 'name' => 'هزینه های حقوق و دستمزد  کارکنان', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '611', 'name' => 'هزینه های اداری و عمومی', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '612', 'name' => 'هزینه های عملیاتی', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '613', 'name' => 'هزینه های توزیع و فروش و بازاریابی', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '614', 'name' => 'هزینه های مالی', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '616', 'name' => 'هزینه استهلاک', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '617', 'name' => 'هزینه خرید', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '618', 'name' => 'هزینه های  واحد اعتباری', 'level' =>1 , 'parent_id'=> $expenseId],
                ['code' => '619', 'name' => 'هزینه های غیر عملیاتی', 'level' =>1 , 'parent_id'=> $expenseId],

                // revenue
                ['code' => '710', 'name' => 'فروش', 'level' =>1 , 'parent_id'=> $revenueId],
                ['code' => '711', 'name' => 'برگشت از فروش و تخفیفات', 'level' =>1 , 'parent_id'=> $revenueId],
                ['code' => '712', 'name' => 'درآمدها', 'level' =>1 , 'parent_id'=> $revenueId],
                ['code' => '713', 'name' => 'درآمد های واحد اعتباری', 'level' =>1 , 'parent_id'=> $revenueId],

                // cost
                ['code' => '810', 'name' => 'بهای تمام شده کالای فروش رفته', 'level' =>1 , 'parent_id'=> $costId],

                // control
                ['code' => '910', 'name' => 'حسابهای کنترلی', 'level' =>1 , 'parent_id'=> $controlId],

            ],
            ['code'], // uniqueBy
            ['name', 'level', 'parent_id'] //update
        );
    }
}
