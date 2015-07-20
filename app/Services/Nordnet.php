<?php

namespace App\Services;

class Nordnet {

    const BASE_URL = 'https://api.test.nordnet.se/next/2/';
    const SERVICE = 'NEXTAPI';

    private $session_key;
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    private function query($endpoint, $post = false, $data = array()) {

        $auth = $this->getSessionKey();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_URL, Nordnet::BASE_URL . $endpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, Nordnet::BASE_URL . $endpoint . '?' . http_build_query($data));
        }
        if ($auth) {
            curl_setopt($ch, CURLOPT_USERPWD, $auth . ':' . $auth);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json"
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        if(is_string($result)){
            return json_decode($result);
        }
        return "No response.";
    }

    function getSessionKey() {

        if(isset($this->session_key)) {
            return $this->session_key;
        }

        $url = Nordnet::BASE_URL .  'login';

        $login_string = base64_encode($this->username) . ':' . base64_encode($this->password) . ':' . base64_encode(time() * 1000);

        $public_key = openssl_get_publickey(file_get_contents(url('NEXTAPI_TEST_public.pem')));
        openssl_public_encrypt($login_string, $login, $public_key);

        $auth = base64_encode($login);

        $post_data = http_build_query(array(
            'auth' => $auth,
            'service' => Nordnet::SERVICE
        ));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response)->session_key;
    }

    function getInstrumentList($market_id = '') {
        $key = $this->getSessionKey();
        return $this->query('lists/' . $market_id, false, array());
    }

    function getInstruments($instruments) {

    }

    function getInstrument($instrument_id) {
        return $this->query('instruments/' . $instrument_id, false, array());
    }
}