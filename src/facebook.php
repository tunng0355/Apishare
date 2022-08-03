<?php
namespace Tungmmo\Apishare\Facebook;

class Http
{
    public static $token;
    public static $cookie;

    public function setToken($token = null)
    {
        static::$token = $token;
    }
    public function setCookie($cookie = null)
    {
        static::$cookie = $cookie;
    }

 
    static public function post($url,$body = null,$header = [],$cookie = null)
    {      
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            return curl_exec($ch);
            curl_close($ch);
    }

    
    public function get($url,$header = [],$cookie = null)
    {      
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            return curl_exec($ch);
            curl_close($ch);
    }

    public function check()
    {
        $data = json_decode($this->get("https://graph.facebook.com/v2.2/me/accounts?access_token=" . static::$token));

        if (isset($data->data)) {
            $output = $this->get("https://mbasic.facebook.com/", [
                "accept: */*",
                "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
                "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                "origin: https://m.facebook.com",
                "referer: https://m.facebook.com/zuck?_rdr",
                "sec-fetch-dest: empty",
                "sec-fetch-mode: cors",
                "sec-fetch-site: same-origin",
                "x-requested-with: XMLHttpRequest",
                "x-response-format: JSONStream",
                'sec-ch-ua-platform: "Windows"',
                "Sec-Fetch-Dest: document",
                "Sec-Fetch-Mode: navigate",
                "Sec-Fetch-Site: none",
                "Sec-Fetch-User: ?1",
                "Upgrade-Insecure-Requests: 1",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36"
            ],static::$cookie);

            if (preg_match('#name="fb_dtsg" value="(.+?)"#is', $output, $dtsg)) {
                return true;
            } else {
                die("cookie tài khoản không chính xác");
            }
        } elseif (isset($data->error)) {
            die("token tài khoản không chính xác");
        } else {
            die("Có lỗi gì đó đã xảy ra");
        }
    }

    static public function getUID($url)
    {
        if (preg_match('#^https?://(?:[^.]+\.)*facebook\.com/#i', $url, $arr)) {

            $page = self::get($url,[
                "Connection: keep-alive",
                "Keep-Alive: 300",
                "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
                "Accept-Language: en-us,en;q=0.5",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36",
                'Expect:'
            ],static::$cookie);

            if (preg_match('#name="target" value="(.+?)"#is', $page, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/videos/(.*?)/#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/videos(.*?)#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/posts/(.*?)/#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/posts(.*?)#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/groups(.*?)#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } elseif (preg_match('#/groups(.*?)#is', $url, $matches)) {
                $msg = ['code' => 200, 'msg' => 'đường dẫn chính xác', 'uid' => $matches[1]];
            } else {
                $msg = ['error' => 302, 'msg' => 'đường dẫn không chính xác'];
            }
        } else {
            $msg = ['error' => 302, 'msg' => 'đường dẫn không hợp lệ'];
        }
        return json_encode($msg);
    }
}
