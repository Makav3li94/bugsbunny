<?php
return [
    'sms' => [
        'mokhaberat' => [
            'title' => 'مخابرات',
            'fast_url' => "http://ippanel.com/class/sms/wsdlservice/server.php?wsdl",
            'send_url' => '37.130.202.188/services.jspd',
            'username' => '09356766574 ',
            'password' => 'Parham@19171363',
            'from_number' => '3000505',
            'errors' => [
                '0'
            ]
        ]
    ],
    'ticket' => [
        'close-time' => 7, //In Days
        'message' => 'با سلام ، پاسخی به درخواست پشتیبانی شما ارسال شده است.' //In Days
    ],
    'sms_resend_times' => [
        '1' => 1,
        '2' => 5,
    ]
];
