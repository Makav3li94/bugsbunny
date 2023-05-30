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
use App\Models\FrontCallTo;
use App\Models\FrontFaq;
use App\Models\FrontFeature;
use App\Models\FrontHero;
use App\Models\FrontMenu;
use App\Models\FrontOverlay;
use App\Models\FrontSocail;
use App\Models\FrontWay;
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
use Carbon\Carbon;
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
        Permission::create(['name' => 'main_page', 'guard_name' => 'admin']);
        Permission::create(['name' => 'sms', 'guard_name' => 'admin']);
        Permission::create(['name' => 'support', 'guard_name' => 'admin']);
        Permission::create(['name' => 'blog', 'guard_name' => 'admin']);
        Permission::create(['name' => 'category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'challenge', 'guard_name' => 'admin']);
        Permission::create(['name' => 'score', 'guard_name' => 'admin']);
        Permission::create(['name' => 'email', 'guard_name' => 'admin']);

        Role::truncate();
        $role = Role::create(['name' => 'مدیر ارشد', 'guard_name' => 'admin'])
            ->givePermissionTo(Permission::all());
        Admin::find(1)->assignRole('مدیر ارشد');

        Blog::create(['title' => 'درباره ما', 'excerpt' => 'صفحه درباره ما', 'slug' => 'about-us', 'description' => 'متن درباره ما', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);
        Blog::create(['title' => 'تماس با ما', 'excerpt' => '', 'slug' => 'contact-us', 'description' => 'متن تماس با ما', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);
        Blog::create(['title' => 'چراایزباگ', 'excerpt' => '', 'slug' => 'why-isbug', 'description' => 'متن چرا ایزباگ', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);
        Blog::create(['title' => 'قوانین انجمن', 'excerpt' => '', 'slug' => 'rules', 'description' => 'متن قوانین انجمن', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);
        Blog::create(['title' => 'سوالات متداول', 'excerpt' => '', 'slug' => 'faqs', 'description' => 'متن سوالات متداول', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);
        Blog::create(['title' => 'مرام نامه', 'excerpt' => '', 'slug' => 'morals', 'description' => 'متن مرام نامه', 'is_page' => 1, 'published_at' => Carbon::now()->toDateTimeString(),]);


        Setting::create(['brand' => 'ایزباگ', 'admin_section_score' => 5, 'user_section_score' => 3, 'name' => 'ایز خیلی خوبه', 'description' => 'گفتم دیگه ایزباگ خیلی خوبه', 'first_logo' => '/uploads/settings/images/logos/1684318429-logo-isbug-main-header.png', 'second_logo' => '/uploads/settings/images/logos/1684318429-logo-isbug-main-header.png', 'comment_score' => 2, 'reply_score' => 1, 'section_score' => 3, 'skip_section_score' => 1, 'reg_type' => 0, 'wysiwyg' => 'خوش آمدید',]);

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


        //Front
        FrontMenu::create(['title' => 'خانه', 'link' => 'home', 'type' => 0]);
        FrontMenu::create(['title' => 'انجمن', 'link' => 'forum', 'type' => 0]);

        FrontMenu::create(['title' => 'انجمن', 'link' => 'forum', 'type' => 1]);
        FrontMenu::create(['title' => 'انجمن', 'link' => 'forum', 'type' => 2]);
        FrontMenu::create(['title' => 'انجمن', 'link' => 'forum', 'type' => 3]);

        FrontHero::create(['title' => 'دنبال باگ خاصی می گردید ؟', 'sub' => ' مشکل خودتون رو جست و جو کنید. ', 'bg' => '', 'search_placeholder' => 'چی میخوای؟']);

        FrontFeature::create(['title' => 'ثبت نام آسان', 'sub' => 'به سادگی در ایزباگ ثبت نام کنید.', 'icon' => 'Lamp_idea.png']);

        FrontWay::create(['title' => 'مسیر همکاری تسترها با ایزباگ', 'sub' => 'تستر ها طی چه مراحلی میتونن با ایزباگ همکاری داشته باشند ؟', 'type' => 1]);

        FrontWay::create(['title' => 'بهترین تجربه تست', 'sub' => 'بهترین تجربه تست ', 'icon' => 'file1.png', 'type' => 0]);

        FrontFaq::create(['title' => 'سوالات متداول', 'sub' => 'اینجا میتوندی سوالات متداول رو مشاهده کنید.', 'type' => 0]);
        FrontFaq::create(['question' => 'سوال 1', 'answer' => 'پاسخ 1', 'type' => 1]);

        FrontOverlay::create(['body' => 'تست', 'bg' => 'feedback_bg.jpg']);


        FrontCallTo::create(['title' => 'میخواید عضو جامعه ایزباگ بشید ؟', 'sub' => 'کافیه ثبت نام کنید.', 'bg' => 'action_bg.jpg', 'link_title' => 'عضویت', 'link' => 'register']);

        FrontSocail::create(['title' => 'twitter', 'icon' => 'twitter.png', 'link' => 'test']);

        SmsSender::create(['title' => 'sms', 'number' => 123, 'type' => 'sms']);
        SmsSetting::create(['title' => 'sms', 'username' => 'none', 'password' => 'none', 'p_confirm_code' => '73357', 'p_ticket' => '73362', 'p_password' => '73361','p_notif' => '75511','sms_sender'=>1]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
