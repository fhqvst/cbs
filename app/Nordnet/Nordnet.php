<?php

namespace App\Nordnet;

use Cache;
use DB;
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

    public function getBorsdata($instrument_id) {

        // @todo: Clean up this giant pile of crap

        $options = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json; charset=UTF-8",
                'content' => json_encode(array(
                    "companyID" => $instrument_id,
                    "selectedKPI" => 6
                )),
                'timeout' => 60
            )
        );

        $url = 'http://borsdata.se/progress/getHighChartJason';

        $kpis = explode(',', "5,6,8,7,23,25,28,29,30,31,32,33,34,36,39,41,46,51,61,68,70,71,73,92,93");

        foreach($kpis as $kp) {

            $options['http']['content'] = json_encode(array(
                "companyID" => $instrument_id,
                "selectedKPI" => $kp
            ));
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            $result = json_decode($result);

            $kpi = $result->KPIData[0];

            $name = $kpi->Name;
            $name = strtolower($name);

            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
            $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
            $name = str_replace($a, $b, $name);

            $name = preg_replace('/[%]+/', 'procent', $name);
            $name = preg_replace('/[- ]+/', '_', $name);
            $name = preg_replace('/[^a-zA-Z0-9_]+/', '', $name);

            foreach($kpi->Data as $data) {

                $date = date_create($data->Day . '-' . $data->Month . '-' . strftime("%Y", $data->Year / 1000));
                $date = $date->format('Y-m-d');
                $value = $data->Value;

                $new = array(
                    'instrument_id' => 1,
                    'meta_key' => $name,
                    'meta_value' => $value,
                    'logged_at' => $date
                );

                $meta = DB::table('instrument_meta')
                    ->where('logged_at', $date)
                    ->where('meta_key', $name)
                    ->get();

                if($meta) {
                    DB::table('instrument_meta')
                        ->where('logged_at', $date)
                        ->where('meta_key', $name)
                        ->update($new);
                } else {
                    DB::table('instrument_meta')->insert($new);
                }
                echo 'Done: ' . $name;

            }



        }

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