<?php
namespace Database\Seeders;

use App\Helper\RolesHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // at first we have to create a super admin role with all permissions for all models.
        RolesHelper::CreateRole('admin', RolesHelper::GetModels(['category,product,user,setting,contact','payment']));

    }
}
