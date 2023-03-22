<?php
namespace Core\Config;

class Recaptcha {
    private String $secret_key;
    private String $site_key;

    public function __construct() {
        $this->secret_key = Config::RECAPTCHA_SECRET_KEY;
        $this->site_key = Config::RECAPTCHA_SITE_KEY;
    }

    public function getSiteKey(): string
    {
        return $this->site_key;
    }

    public function getFormInput(): string
    {
        return '<div class="g-recaptcha" data-sitekey="' . $this->getSiteKey() . '"></div>';
    }

    public function getHeadScript(): string
    {
        $url = base64_decode('aHR0cHM6Ly93d3cuZ29vZ2xlLmNvbS9yZWNhcHRjaGEvYXBpLmpz');
        return '<script src="'.$url.'" async defer></script>';
    }

    public function verifyResponse($response, $remote_ip = null): bool
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->secret_key,
            'response' => $response
        );
        if ($remote_ip !== null) {
            $data['remoteip'] = $remote_ip;
        }
        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === false) {
            return false;
        }
        $response_data = json_decode($result);
        return $response_data->success === true;
    }
}