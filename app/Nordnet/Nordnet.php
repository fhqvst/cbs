<?php

namespace App\Nordnet;

use Cache;
use App\Nordnet\Contracts\NordnetContract;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Nordnet
 * @package App\Nordnet
 */
class Nordnet implements NordnetContract {

    const BASE_URL = 'https://api.test.nordnet.se/next/2/';
    const SERVICE = 'NEXTAPI';

    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Sends a GET request to $endpoint with $query.
     * @param $endpoint
     * @param array $query
     * @return mixed
     */
    private function get($endpoint, array $query = []) {
        return $this->query($endpoint, 'GET', $query);
    }

    /**
     * Sends a POST request to $endpoint with $data.
     * @param $endpoint
     * @param array $data
     * @return mixed
     */
    private function post($endpoint, array $data) {
        return $this->query($endpoint, 'POST', $data);
    }

    /**
     * Sends a a cURL request to $endpoint by $method with $content.
     * If $auth is set to false the request won't use HTTP-auth.
     * This is currently only used when logging in. For all other
     * endpoints auth is always required.
     *
     * @param $endpoint
     * @param $method
     * @param array $content
     * @param bool $auth
     * @return mixed
     */
    private function query($endpoint, $method, array $content, $auth = true) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (strtoupper($method) == 'POST') {

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_URL, Nordnet::BASE_URL . $endpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($content));

        } else if (strtoupper($method) == 'GET') {

            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, Nordnet::BASE_URL . $endpoint . '?' . http_build_query($content));

        } else {
            throw new HttpException('406', "Only POST and GET methods are allowed.");
        }

        if($auth) {
            if(!Cache::has('nordnet_session')) {
                $this->authenticate();
            }
            curl_setopt($ch, CURLOPT_USERPWD, Cache::get('nordnet_session') . ':' . Cache::get('nordnet_session'));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch)['http_code'];

        curl_close($ch);

        // 401 = Current session key somehow has expired
        if($status == 401) {
            $this->authenticate();
            return $this->query($endpoint, $method, $content);
        }

        return json_decode($response);
    }

    /**
     * Get an instrument by id.
     * @param $instrument_id
     * @return mixed
     */
    public function getInstrument($instrument_id)
    {
        return $this->get('instruments/' . $instrument_id);
    }

    /**
     * Returns a list of instruments by market id, or a list of all
     * available market id's,
     *
     * @param string $market_id
     * @return mixed
     */
    public function getInstrumentList($market_id = '')
    {
        return $this->get('lists/' . $market_id);
    }

    public function getTradables($identifier) {
        return $this->get('tradables/intraday/' . $identifier);
    }

    /**
     * Authenticates the app to the Nordnet nEXT API and caches the
     * returned session key for 4 minutes. The session key itself is valid
     * for 5.
     *
     * @return string
     */
    public function authenticate() {
        $login_string = base64_encode($this->username) . ':' . base64_encode($this->password) . ':' . base64_encode(time() * 1000);

        $public_key = openssl_get_publickey(file_get_contents(url('NEXTAPI_TEST_public.pem')));
        openssl_public_encrypt($login_string, $login, $public_key);

        $response = $this->query('login', 'POST', array(
            'auth' => base64_encode($login),
            'service' => Nordnet::SERVICE
        ), false);

        if(property_exists($response, 'session_key')) {
            Cache::put('nordnet_session', $response->session_key, 4);
        }
        return json_encode($response);
    }

}