# Config 
Sistemin genel olarak ayarlarini *`Core/Config/Config.php`* dosyasi uzerinden yapmak gerekmektedir. Sistemin genel olarak bilgileri bu alanda yer almakta olup belirli ozellikleri bu kisimdan Aktif/Pasif edebilirsiniz.

|Property|Type|Default|Description|
|--|--|--|--|--|
|$base_url|String|http://localhost|Web sitenizin linkinin yer aldigi ve cogu yonlendirmelerin kapsandigi genel sabit.|
|SMTP_HOST|String|random|smtp baglanti adresi ornk: smtp.example.com|
|SMTP_USERNAME|String|random|smtp kullanici adi ornk: name@example.com|
|SMTP_PASSWORD|String|random|smtp parolasi ornk: 123456789|
|SMTP_PORT|Number|465|Baglanti portu|
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
|$origin|Boolean|TRUE|Cors izni verilsin mi?
|$databases|Array|null|Veritabani baglantilari icin kullanilacak baglanti bilgileri
|base_url|Function|null|Web sitenizin url bilgisini dondurur ve ekleme yapar
|current_url|Function|null|Mevcut adresi geri dondurur
|path_rate_limiter|Function|null|RateLimiter eklentisinin Temp dosya yolunu belirtir
|path_sessions|Function|null|Oturum bilgilerinin Temp dosya yolunu belirtir
|path_uploads|Function|null|Yuklenen dosyalarin Temp dosya yolunu belirtir
