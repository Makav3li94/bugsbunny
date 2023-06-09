<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    'dimensions' => ':attribute فاقد ابعاد مجاز می باشد.',
    'distinct' => ':attribute باید متمایز باشد.',
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    'uploaded' => ':attribute عدم موفقیت در آپلود.',
    "url" => "فرمت آدرس :attribute اشتباه است.",
    "recaptcha" => "فیلد :attribute صحیح نمی باشد.",
    "captcha" => "فیلد :attribute صحیح نمی باشد.",


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'country.*' => [
            'required' => 'فیلد کشور تحصیلی الزامی است'
        ],
        'visa.*' => [
            'required' => 'فیلد ویزا تحصیلی الزامی است'
        ],
        'reply.*' => [
            'required' => 'فیلد پاسخ الزامی است'
        ],
        'file.*' => [
            'max' => 'فایل نباید بزرگتر از :max کیلوبایت باشد',
            "mimes" => "فایل باید یکی از فرمت های :values باشد",
        ],
        'result'=>[
            'required'=>'فیلد فوق اجباری است',
            'numeric'=>'فیلد فوق فقط موارد عددی را می پذیرد',
            'integer'=>'فیلد فوق فقط اعداد صحیح را می پذیرد',
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        "name" => "نام",
        "price" => "قیمت",
        "username" => "نام کاربری",
        "email" => "ایمیل",
        "password" => "رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "altMobile" => "تلفن همراه جایگزین",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "slug" => "نامک",
        "tags" => "برچسب ها",
        "tag" => "برچسب",
        "category" => "دسته بندی",
        "demo" => "متن کوتاه",
        "update" => "تاریخ به روز رسانی",
        "image" => "فایل عکس",
        "position" => "سمت ",
        "resume" => "رزومه ",
        "question" => "سوال",
        "reply" => "پاسخ",
        "percent" => "درصد",
        'fax' => 'فکس',
        'keywords' => 'کلمات کلیدی',
        'designer' => 'طراح',
        'security' => 'ایمن کننده',
        'copyright' => 'کپی رایت',
        'path' => 'مسیر',
        'url' => 'آدرس',
        'g-recaptcha-response' => 'کد کپچا',
        'captcha' => 'کد کپچا',
        'cost' => 'قیمت',
        'views' => 'بازدید',
        'logo' => 'لوگو',
        'color' => 'رنگ',
        'type' => 'نوع',
        'code' => 'کد',
        'link' => 'لینک',
        'latitude' => 'عرض جغرافیایی',
        'longitude' => 'طول جغرافیایی',
        'oldPassword' => 'رمز عبور قدیمی',
        'province' => 'استان',
        'postalCode' => 'کد پستی',
        'melliCode' => 'کد ملی',
        'melli_code' => 'کد ملی',
        'pre-number' => 'پیش شماره',
        'field_of_study' => 'رشته تحصیلی',
        'degree' => 'مقطع تحصیلی',
        'university' => 'نام دانشگاه',
        'average' => 'معدل',
        'newsletter' => 'خبرنامه',
        'website' => 'وب سایت',
        'site' => 'سایت',
        'receiver' => 'دریافت کننده',
        'sms' => 'پیامک',
        'counts' => 'تعداد',
        'downloads' => 'تعداد دانلود ها',
        'maritalStatus' => 'وضعیت تاهل',
        'birthDate' => 'تاریخ تولد',
        'birthProvince' => 'محل تولد',
        'livingProvince' => 'محل زندگی',
        'militaryServiceStatus' => 'وضعیت سربازی',
        'familiarity' => 'نحوه آشنایی',
        'visa' => 'ویزا',
        'cashToEmigrate' => 'فوق',
        'everTraveledToEurope' => 'فوق',
        'everRejectedFromSchengen' => 'فوق',
        'schengen' => 'ویزای شنگن',
        'badConduct' => 'سوء سابقه',
        'universityType' => 'دانشگاه',
        'major' => 'رشته تحصیلی',
        'graduateStatus' => 'وضعیت',
        'jobTitle' => 'عنوان شغلی',
        'companyName' => 'نام شرکت',
        'employmentType' => 'نوع استخدام',
        'cooperationType' => 'نوع همکاری',
        'insuranceDuration' => 'سابقه بیمه',
        'occupationStatus' => 'وضعیت',
        'licenseTitle' => 'عنوان مهارت',
        'licensePublisher' => 'صادر کننده مدرک',
        'researchTitle' => 'عنوان پژوهش',
        'researchType' => 'نوع پژوهش',
        'languageType' => 'نوع زبان',
        'languageLicense' => 'نوع مدرک',
        'languageLevel' => 'سطح آشنایی',
        'point' => 'نمره',
        'fileTitle' => 'موضوع فایل',
        'file' => ' فایل',
        'relationship' => 'نسبت',
        'importance' => 'اهمیت',
        'cmt' => 'موضوع',
        'to_date' => 'تاریخ',
        'from_date' => 'تاریخ',
        'connection' => 'نسبت',
        'PUser' => 'مالک حساب',
        'relation' => 'کد پرونده',
        'from_id' => 'فوق',
        'to_id' => 'فوق',
        'smsSender' => 'شماره',
        'number' => 'شماره',
        'section' => 'بخش',
        'priority' => 'اهمیت',
        'time_range' => 'بازه زمانی',
        'first_logo' => 'لوگو',
        'second_logo' => 'لوگو',
        'wysiwyg' => 'متن خوش آمد گویی',
        'image_link' => 'لینک عکس',
        'service' => 'سرویس دهنده',
        'message' => 'پیام',
        'draft' => 'متن پیش نویس',
        'n_code' => 'کدملی',
        'company_role_id' => 'پست شرکتی',
        'signature' => 'امضا',
        'saham' => 'سهام',
        'user_category_id ' => 'دسته بندی کسب و کار',
        'company_name' => 'نام شرکت',
        'company_email' => 'ایمیل شرکت',
        'company_mobile' => 'تلفن همراه شرکت',
        'excerpt' => 'چکیده',
        'about' => 'درباره',
        'bussines_code' => 'شناسه کسب و کار',
        'economy_code' => 'شناسه اقتصادی',
        'postal_code' => 'کد پستی',
        'bime_code' => 'کد بیمه',
        'national_code' => 'کد ملی',
        'face_fin' => 'گردش مالی',
        'year_fin' => 'صورت مالی',
        'sheba' => 'شماره شبا',
        'main_image' => 'تصویر',
        'cash' => 'مبلغ',
        'shenas' => 'شناسنامه',
        'id_card' => 'کارت ملی',
        'money' => 'مبلغ',
        'is_active' => 'وضعیت',
        'explanation' => 'توضیحات',
        'is_active_answer' => 'پاسخ صحیح',
        'answer' => 'پاسخ ',
    ),
);
