<?php
namespace App\Helpers;

use App\Exceptions\JwtException;
use Exception;
use Firebase\JWT\JWT;

class JwtHelper implements Auth
{
    private $secret;
    private $encrypt;
    private $aud;

    public function __construct()
    {
        $this->secret = $_ENV["API_JWT"];
        $this->encrypt = [$_ENV["API_ENCRYPT"]];
        $this->aud = null;
    }

    public function signIn(array $data): string
    {
        $time = time();

        $token = [
            'exp' => $time + (60*60),
            'aud' => $this->aud(),
            'data' => $data
        ];

        return JWT::encode($token, $this->secret);
    }

    public function check(string $token): void
    {
        try {
            $decode = JWT::decode(
                $token,
                $this->secret,
                $this->encrypt
            );
    
            if ($decode->aud !== $this->aud()) {
                throw new JwtException("Usuario invalido", 401);
            }
        } catch (Exception $e) {
            throw new JwtException("Token invalido", 401);
        }
    }

    public function getData(string $token): string
    {
        return JWT::decode(
            $token,
            $this->secret,
            $this->encrypt
        )->data;
    }

    private function aud(): string
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}