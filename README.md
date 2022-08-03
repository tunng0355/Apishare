<p dir="auto"><b>cài đặt thư viện :</b></p>
<pre>composer require tungmmo/apishare</pre>
<p dir="auto"><b>Mở class :</b></p>

<pre>
   use Tungmmo\Apishare\Facebook\Http;
   $tungmmo = new http();
</pre>

<p dir="auto"><b>setup tài nguyên:</b></p>

<pre>
   // cài đặt
   $tungmmo->setToken("DIEN_TOKEN_FACEBOOK_CUA_BAN");
   $tungmmo->setCookie("DIEN_COOKIE_FACEBOOK_CUA_BAN");
   // check live or die
   $tungmmo->check()
</pre>

<p dir="auto"><b>sử dụng thư viện</b></p>
<p dir="auto">get uid hàng loạt bằng url:</p>
<pre>
  http::getUID("DIEN_URL_FACEBOOK_CAN_GET_UID");
</pre>
<p dir="auto">hiện thư viện đang trong quá trình update nên mỗi tuần bạn nên <code>composer update</code> để update những chức năng mới !</p>
<p dir="auto">Update lần đầu sẽ tiến hành hoàn tất chức năng vào ngày 15/8/2022 !</p>

