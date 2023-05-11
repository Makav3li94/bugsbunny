<?php

use App\Models\Admin;
use App\Models\BankCategory;
use App\Models\Blog;
use App\Models\CashRequestCategory;
use App\Models\Category;
use App\Models\Chain;
use App\Models\CompanyCategories;
use App\Models\CreditCategory;
use App\Models\Familiarity;
use App\Models\File;
use App\Models\FinancialClaimsCategory;
use App\Models\GuaranteeCategory;
use App\Models\Kind;
use App\Models\PaymentCategory;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\Setting;
use App\Models\FileTitle;
use App\Models\CompanyRoles;
use App\Models\SmsSender;
use App\Models\SmsSetting;
use App\Models\Type;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Admin::factory(1)->create();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'dashboard', 'guard_name' => 'admin']);
        Permission::create(['name' => 'main-account', 'guard_name' => 'admin']);
        Permission::create(['name' => 'admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'setting', 'guard_name' => 'admin']);
        Permission::create(['name' => 'sms', 'guard_name' => 'admin']);
        Permission::create(['name' => 'support', 'guard_name' => 'admin']);
        Permission::create(['name' => 'blog', 'guard_name' => 'admin']);
        Permission::create(['name' => 'category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'challenge', 'guard_name' => 'admin']);

        Role::truncate();
        $role = Role::create(['name' => 'مدیر ارشد', 'guard_name' => 'admin'])
            ->givePermissionTo(Permission::all());
        Admin::find(1)->assignRole('مدیر ارشد');


        Familiarity::create(['title' => 'موتورهای جستجوگر']);
        Familiarity::create(['title' => 'شبکه های اجتماعی']);
        Familiarity::create(['title' => 'دوستان و آشنایان']);
        Familiarity::create(['title' => 'تبلیغات بنری']);
        Familiarity::create(['title' => 'پیامک مارکتینگ']);
        Familiarity::create(['title' => 'ایمیل مارکتینگ']);
        Familiarity::create(['title' => 'سایر']);

        Category::create(['title' => 'JAVA']);
        Category::create(['title' => 'PHP']);
        Category::create(['title' => 'GoLang']);
        Category::create(['title' => 'Python']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
