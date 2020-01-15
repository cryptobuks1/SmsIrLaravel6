# Install
Via composer
<pre>composer require mahdiidea/sms-ir-laravel6</pre>

# Config
Add the following provider to providers part of config/app.php
<pre>
MahdiIDea\SmsIrLaravel6\SmsIrServiceProvider::class
</pre>
Now add Sms.Ir info to config/app.php
<pre>
'SMS_IR_LINE' => env('SMS_IR_LINE', '3000573007'),
'SMS_IR_SECRET_KEY' => env('SMS_IR_SECRET_KEY', 'shop@atrin2'),
'SMS_IR_API_KEY' => env('SMS_IR_API_KEY', '5b6fc677a00bce331c63a090'),
</pre>
