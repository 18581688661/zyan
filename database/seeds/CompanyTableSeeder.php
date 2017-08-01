<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = factory(Company::class)->times(10)->make();
        Company::insert($companies->toArray());

        $company = Company::find(1);
        $company->company_account = 'xule';
        $company->password = bcrypt('111111');
        $company->save();
    }
}
