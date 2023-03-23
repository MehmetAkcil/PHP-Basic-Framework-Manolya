# Config 
Sistemin genel olarak ayarlarini *`Core/Config/Config.php`* dosyasi uzerinden yapmak gerekmektedir. Sistemin genel olarak bilgileri bu alanda yer almakta olup belirli ozellikleri bu kisimdan Aktif/Pasif edebilirsiniz.

| Property | Type | Default | Description
|--|--|--|--|
|$base_url|String|http://localhost|Web sitenizin linkinin yer aldigi ve cogu yonlendirmelerin kapsandigi genel sabit.
|SMTP_HOST|String|random|smtp baglanti adresi ornk: smtp.example.com
|SMTP_USERNAME|String|random|smtp kullanici adi ornk: name@example.com
|SMTP_PASSWORD|String|random|smtp parolasi ornk: 123456789
|SMTP_PORT|Number|465|Baglanti portu
|SMTP_MAILER|String|Mailer|Gonderici isim soyisim bilgisi
|CSRF_TOKEN_NAME|String|csrftoken|csrf guvenlik tokeni icin input ismi belirlenir
|CSRF_TOKEN_NAME_SESSION|String|csrftokensession|csrf guvenlik tokeni icin oturum saklama ismi
|RECAPTCHA_SECRET_KEY|String|No|Google robot dogrulamasi v2 icin gizli anahtar
|RECAPTCHA_SITE_KEY|String|No|Google robot dogrulamasi v2 icin site anahtari
|RATE_LIMITER_STATUS|Boolean|FALSE|Ip adresine bagli olarak web sitesine dakikada max atilabilecek istek sinirlamasi aktif edilsin mi?
|RATE_LIMITER_EXPIRATION|Number|20|Eger max istek limiti asilmis ise kac saniye engellesin.
|RATE_LIMITER_MAX_REQUESTS_PER_MINUTE|Number|10|Atilabilecek max istek adeti
|IP_RESTRICTOR_STATUS|Boolean|FALSE|Web sitenize erisim kisitlamasi aktif edilsin mi?
|IP_RESTRICTOR_ALLOWED|Array|null|Web sitenize erisimine izin verdiginiz kullanici listesi
|JWT_SECRET_TOKEN|String|null|Jwt Token icin gizli anahtar|
|$origin|Boolean|TRUE|Cors izni verilsin mi?
|$databases|Array|null|Veritabani baglantilari icin kullanilacak baglanti bilgileri
|base_url|Function|null|Web sitenizin url bilgisini dondurur ve ekleme yapar
|current_url|Function|null|Mevcut adresi geri dondurur
|path_rate_limiter|Function|null|RateLimiter eklentisinin Temp dosya yolunu belirtir
|path_sessions|Function|null|Oturum bilgilerinin Temp dosya yolunu belirtir
|path_uploads|Function|null|Yuklenen dosyalarin Temp dosya yolunu belirtir
|path_cache|Function|null|Onbellekleme islemi icin kullanilan gecici dosyalarin saklandigi dizin|


    <?php

		namespace Core\Config;

		class Config
		{

	    public static string $base_url = 'http://paketsatisold/';
	    const SMTP_HOST = 'smtp.example.com';
	    const SMTP_USERNAME = 'name@example.com';
	    const SMTP_PASSWORD = '';
	    const SMTP_PORT = 465;
	    const SMTP_MAILER = 'Mailer';
	    const CSRF_TOKEN_NAME = 'csrftoken';
	    const CSRF_TOKEN_NAME_SESSION = 'csrftoken';
	    const RECAPTCHA_SECRET_KEY = '6LdJTCMlAAAAAKhYb8bs7LmOoJqToHPzIdh000000';
	    const RECAPTCHA_SITE_KEY = '6LdJTCMlAAAAAIWR-u5IgtLRkIy07ctNez000000';

	    const RATE_LIMITER_STATUS = FALSE;
	    const RATE_LIMITER_EXPIRATION = 20; // 20 second
	    const RATE_LIMITER_MAX_REQUESTS_PER_MINUTE = 10; // 20 second

	    const IP_RESTRICTOR_STATUS = FALSE;
	    const IP_RESTRICTOR_ALLOWED = ['127.0.0.1', '192.168.1.1'];


	    const JWT_SECRET_TOKEN = 'hajstu6ts7n459j0qhgdrqnur8';


	    public static bool $origin = TRUE;
	    public static array $databases = [
	        'default' => [
	            'host' => 'localhost',
	            'username' => 'root',
	            'password' => '',
	            'database' => 'gorevyap_react'
	        ],
	        'gorevyap' => [
	            'host' => 'localhost',
	            'username' => 'root',
	            'password' => '',
	            'database' => 'gorevyap'
	        ]
	    ];

	    public static function base_url($url = ''): string
	    {
	        $baseurl = Config::$base_url;
	        if($url === '/'){
	            return $baseurl;
	        }

	        $end = substr($baseurl, -1, 1);
	        if($end != '/'){
	            $baseurl .= '/';
	        }

	        $end = substr($url, 0, 1);

	        if($end == '/'){
	            $url = ltrim($url, '/');
	        }

	        return $baseurl . $url;
	    }

	    public static function current_url(): string
	    {

	        return self::base_url(Header::getServer('REQUEST_URI'));
	    }

	    public static function path_rate_limiter(): string
	    {
	        return Header::getServer('DOCUMENT_ROOT') . '/Temp/RateLimiter/';
	    }

	    public static function path_cache(): string
	    {
	        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Cache/';
	    }

	    public static function path_sessions(): string
	    {
	        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Sessions/';
	    }

	    public static function path_uploads(): string
	    {
	        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Uploads/';
	    }
	}

