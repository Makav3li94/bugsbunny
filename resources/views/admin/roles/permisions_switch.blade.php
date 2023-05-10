@php
    switch ($permission->name) {
        case "dashboard":
            echo "پیشخوان";
            break;
        case "file":
            echo "مدیریت فایل ها";
            break;
        case "main-account":
            echo "حساب اصلی";
            break;
        case "sub-account":
            echo "اعضا شرکت";
            break;
         case "analyze":
            echo "آنالیز";
            break;
        case "jobs":
            echo "مدیریت کارها";
            break;
        case "support":
            echo "پشتیبانی";
            break;
        case "admin":
            echo "مدیران";
            break;
        case "setting":
            echo "تنظیمات";
            break;
        case "sms":
            echo "پیامک";
            break;
        case "transactions":
            echo "امور مالی";
            break;
        case "cats":
            echo "دسته بندی ها";
            break;
        case "products":
            echo "محصولات";
            break;
        case "invoice":
            echo "تراکنش ها";
            break;
        case "blog":
            echo "صفحات";
            break;
        case "orders":
            echo "سفارشات";
            break;

        default:
        echo "--سطوح دسترسی--";
     }
@endphp
