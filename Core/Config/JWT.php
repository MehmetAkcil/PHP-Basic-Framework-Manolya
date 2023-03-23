<?php
namespace Core\Config;
use Exception;

class JWT
{
    private string $secret;

    public function __construct($secret = null)
    {
        $this->secret = $secret ?: Config::JWT_SECRET_TOKEN;
    }

    public function encode($detail, $extraPayload, $exp = 3600): string
    {
        $header = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $iat = time(); // current timestamp value
        $exp = $iat + $exp;
        $payload = array(
            "iss" => Header::getServer('HTTP_HOST'),
            "aud" => $detail,
            "sub" => Header::getServer('HTTP_HOST'),
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
        );
        $payload = array_merge($payload, $extraPayload);
        $payload = json_encode($payload);


        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $this->secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    /**
     * @throws Exception
     */
    public function decode($jwt)
    {
        $jwtParts = explode('.', $jwt);

        if (count($jwtParts) !== 3) {
            throw new Exception('Invalid JWT');
        }

        $header = json_decode($this->base64UrlDecode($jwtParts[0]), true);
        $payload = json_decode($this->base64UrlDecode($jwtParts[1]), true);
        $signature = $this->base64UrlDecode($jwtParts[2]);

        if (!isset($header['alg']) || $header['alg'] !== 'HS256') {
            throw new Exception('Invalid JWT algorithm');
        }

        if (!$this->verifySignature("$jwtParts[0].$jwtParts[1]", $signature)) {
            throw new Exception('Invalid JWT signature');
        }

        return $payload;
    }

    private function base64UrlEncode($data): array|string
    {
        $base64 = base64_encode($data);
        return str_replace(['+', '/', '='], ['-', '_', ''], $base64);
    }

    private function base64UrlDecode($base64Url): false|string
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $base64Url);
        $base64Padding = strlen($base64) % 4;

        if ($base64Padding) {
            $base64 .= str_repeat('=', 4 - $base64Padding);
        }

        return base64_decode($base64);
    }

    private function verifySignature($data, $signature): bool
    {
        $expectedSignature = hash_hmac('sha256', $data, $this->secret, true);

        return hash_equals($signature, $expectedSignature);
    }
}