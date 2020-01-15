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
'SMS_IR_LINE' => 'Your line',
'SMS_IR_SECRET_KEY' => 'Your secret key',
'SMS_IR_API_KEY' => 'Your APi key',
</pre>
# Methods
send message 
<pre>
SmsResolver::instance()->send($phone,$text);
</pre>
get credit
<pre>$credit = SmsResolver::instance()->credit();</pre>
get sms lines
<pre>$lines = SmsResolver::instance()->lines();</pre>
send verification code
<pre>$lines = SmsResolver::instance()->verification($phone, $code);</pre>
ultra Fast Send 
<pre>SmsResolver::instance()->ultraFastSend($data);</pre>
