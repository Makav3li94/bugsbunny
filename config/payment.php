<?php return array (
  'default' => 'zarinpal',
  'drivers' => 
  array (
    'asanpardakht' => 
    array (
      'apiPurchaseUrl' => 'https://services.asanpardakht.net/paygate/merchantservices.asmx?wsdl',
      'apiPaymentUrl' => 'https://asan.shaparak.ir',
      'apiVerificationUrl' => 'https://services.asanpardakht.net/paygate/merchantservices.asmx?wsdl',
      'apiUtilsUrl' => 'https://services.asanpardakht.net/paygate/internalutils.asmx?wsdl',
      'key' => '',
      'iv' => '',
      'username' => '',
      'password' => '',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using asanpardakht',
    ),
    'behpardakht' => 
    array (
      'apiPurchaseUrl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
      'apiPaymentUrl' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
      'apiVerificationUrl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
      'apiNamespaceUrl' => 'http://interfaces.core.sw.bps.com/',
      'terminalId' => '',
      'username' => '',
      'password' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using behpardakht',
    ),
    'idpay' => 
    array (
      'apiPurchaseUrl' => 'https://api.idpay.ir/v1.1/payment',
      'apiPaymentUrl' => 'https://idpay.ir/p/ws/',
      'apiSandboxPaymentUrl' => 'https://idpay.ir/p/ws-sandbox/',
      'apiVerificationUrl' => 'https://api.idpay.ir/v1.1/payment/verify',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using idpay',
      'sandbox' => false,
    ),
    'irankish' => 
    array (
      'apiPurchaseUrl' => 'https://ikc.shaparak.ir/XToken/Tokens.xml',
      'apiPaymentUrl' => 'https://ikc.shaparak.ir/TPayment/Payment/index/',
      'apiVerificationUrl' => 'https://ikc.shaparak.ir/XVerify/Verify.xml',
      'merchantId' => '',
      'sha1Key' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using irankish',
    ),
    'nextpay' => 
    array (
      'apiPurchaseUrl' => 'https://api.nextpay.org/gateway/token.http',
      'apiPaymentUrl' => 'https://api.nextpay.org/gateway/payment/',
      'apiVerificationUrl' => 'https://api.nextpay.org/gateway/verify.http',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using nextpay',
    ),
    'parsian' => 
    array (
      'apiPurchaseUrl' => 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl',
      'apiPaymentUrl' => 'https://pec.shaparak.ir/NewIPG/',
      'apiVerificationUrl' => 'https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?wsdl',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using parsian',
    ),
    'pasargad' => 
    array (
      'apiPaymentUrl' => 'https://pep.shaparak.ir/payment.aspx',
      'apiGetToken' => 'https://pep.shaparak.ir/Api/v1/Payment/GetToken',
      'apiCheckTransactionUrl' => 'https://pep.shaparak.ir/Api/v1/Payment/CheckTransactionResult',
      'apiVerificationUrl' => 'https://pep.shaparak.ir/Api/v1/Payment/VerifyPayment',
      'merchantId' => '',
      'terminalCode' => '',
      'certificate' => '',
      'certificateType' => 'xml_file',
      'callbackUrl' => 'http://yoursite.com/path/to',
    ),
    'payir' => 
    array (
      'apiPurchaseUrl' => 'https://pay.ir/pg/send/',
      'apiPaymentUrl' => 'https://pay.ir/pg/',
      'apiVerificationUrl' => 'https://pay.ir/pg/verify/',
      'merchantId' => 'test',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using payir',
    ),
    'paypal' => 
    array (
      'apiPurchaseUrl' => 'https://www.paypal.com/cgi-bin/webscr',
      'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
      'apiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
      'sandboxApiPurchaseUrl' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
      'sandboxApiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
      'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',
      'mode' => 'normal',
      'currency' => '',
      'id' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using paypal',
    ),
    'payping' => 
    array (
      'apiPurchaseUrl' => 'https://api.payping.ir/v1/pay/',
      'apiPaymentUrl' => 'https://api.payping.ir/v1/pay/gotoipg/',
      'apiVerificationUrl' => 'https://api.payping.ir/v1/pay/verify/',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using payping',
    ),
    'paystar' => 
    array (
      'apiPurchaseUrl' => 'https://paystar.ir/api/create/',
      'apiPaymentUrl' => 'https://paystar.ir/paying/',
      'apiVerificationUrl' => 'https://paystar.ir/api/verify/',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using paystar',
    ),
    'poolam' => 
    array (
      'apiPurchaseUrl' => 'https://poolam.ir/invoice/request/',
      'apiPaymentUrl' => 'https://poolam.ir/invoice/pay/',
      'apiVerificationUrl' => 'https://poolam.ir/invoice/check/',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using poolam',
    ),
    'sadad' => 
    array (
      'apiPurchaseUrl' => 'https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest',
      'apiPaymentUrl' => 'https://sadad.shaparak.ir/VPG/Purchase',
      'apiVerificationUrl' => 'https://sadad.shaparak.ir/VPG/api/v0/Advice/Verify',
      'key' => '',
      'merchantId' => '',
      'terminalId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using sadad',
    ),
    'saman' => 
    array (
      'apiPurchaseUrl' => 'https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',
      'apiPaymentUrl' => 'https://sep.shaparak.ir/payment.aspx',
      'apiVerificationUrl' => 'https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL',
      'merchantId' => '',
      'callbackUrl' => '',
      'description' => 'payment using saman',
    ),
    'yekpay' => 
    array (
      'apiPurchaseUrl' => 'https://gate.yekpay.com/api/payment/server?wsdl',
      'apiPaymentUrl' => 'https://gate.yekpay.com/api/payment/start/',
      'apiVerificationUrl' => 'https://gate.yekpay.com/api/payment/server?wsdl',
      'fromCurrencyCode' => 978,
      'toCurrencyCode' => 364,
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using yekpay',
    ),
    'zarinpal' => 
    array (
      'apiPurchaseUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
      'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
      'apiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
      'sandboxApiPurchaseUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',
      'sandboxApiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
      'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',
      'zaringateApiPurchaseUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
      'zaringateApiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/:authority/ZarinGate',
      'zaringateApiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
      'mode' => 'sandbox',
      'merchantId' => '%merchantId%',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment in Mohajergram',
    ),
    'zibal' => 
    array (
      'apiPurchaseUrl' => 'https://gateway.zibal.ir/v1/request',
      'apiPaymentUrl' => 'https://gateway.zibal.ir/start/',
      'apiVerificationUrl' => 'https://gateway.zibal.ir/v1/verify',
      'mode' => 'normal',
      'merchantId' => '',
      'callbackUrl' => 'http://yoursite.com/path/to',
      'description' => 'payment using zibal',
    ),
  ),
  'map' => 
  array (
    'asanpardakht' => 'Shetabit\\Multipay\\Drivers\\Asanpardakht\\Asanpardakht',
    'behpardakht' => 'Shetabit\\Multipay\\Drivers\\Behpardakht\\Behpardakht',
    'idpay' => 'Shetabit\\Multipay\\Drivers\\Idpay\\Idpay',
    'irankish' => 'Shetabit\\Multipay\\Drivers\\Irankish\\Irankish',
    'nextpay' => 'Shetabit\\Multipay\\Drivers\\Nextpay\\Nextpay',
    'parsian' => 'Shetabit\\Multipay\\Drivers\\Parsian\\Parsian',
    'pasargad' => 'Shetabit\\Multipay\\Drivers\\Pasargad\\Pasargad',
    'payir' => 'Shetabit\\Multipay\\Drivers\\Payir\\Payir',
    'paypal' => 'Shetabit\\Multipay\\Drivers\\Paypal\\Paypal',
    'payping' => 'Shetabit\\Multipay\\Drivers\\Payping\\Payping',
    'paystar' => 'Shetabit\\Multipay\\Drivers\\Paystar\\Paystar',
    'poolam' => 'Shetabit\\Multipay\\Drivers\\Poolam\\Poolam',
    'sadad' => 'Shetabit\\Multipay\\Drivers\\Sadad\\Sadad',
    'saman' => 'Shetabit\\Multipay\\Drivers\\Saman\\Saman',
    'yekpay' => 'Shetabit\\Multipay\\Drivers\\Yekpay\\Yekpay',
    'zarinpal' => 'Shetabit\\Multipay\\Drivers\\Zarinpal\\Zarinpal',
    'zibal' => 'Shetabit\\Multipay\\Drivers\\Zibal\\Zibal',
  ),
  'zarinpal' => 
  array (
    'merchantId' => '2b8b3f4c-887b-11ea-b561-000c295eb8fc',
  ),
);