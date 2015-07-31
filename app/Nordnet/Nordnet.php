<?php

namespace App\Nordnet;

use Cache;
use DB;
use App\Instrument;
use App\Metadata;
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

    public function getBorsdata() {

        $indices = array(
            "5" => "revenue",
            "6" => "income",
            "7" => "dividend",
            "8" => "equity",
            "23" => "free_cash_flow",
            "25" => "capex_percent",
            "28" => "gross_margin",
            "29" => "ebit_margin",
            "30" => "income_margin",
            "31" => "fcf_margin",
            "32" => "ebitda_margin",
            "33" => "return_on_equity",
            "34" => "return_on_assets",
            "36" => "return_on_capital",
            "39" => "solidity",
            "41" => "net_debt_percent",
            "46" => "cash_percent",
            "51" => "operating_margin",
            "61" => "shares",
            "68" => "operating_cash_flow",
            "70" => "ebit",
            "71" => "ebitda",
            "73" => "net_debt",
            "92" => "intangible_assets_percent",
            "93" => "working_capital_percent"
        );

        $companies = array(
            "2" => "aak",
            "3" => "abb",
            "258" => "aoi",
            "10" => "alfa",
            "17" => "assa",
            "18" => "azn",
            "19" => "atco",
            "20" => "ljgr",
            "21" => "aliv",
            "24" => "axfo",
            "25" => "axis",
            "32" => "bets",
            "34" => "bill",
            "40" => "bol",
            "46" => "cast",
            "373" => "comh",
            "70" => "elux",
            "71" => "ekta",
            "75" => "enq",
            "77" => "eric",
            "80" => "fabg",
            "83" => "bald",
            "611" => "baldpref",
            "88" => "geti",
            "204" => "shb",
            "97" => "hm",
            "98" => "hexa",
            "99" => "hpol",
            "102" => "holm",
            "103" => "hufv",
            "104" => "husq",
            "92" => "ica",
            "109" => "indu",
            "110" => "indt",
            "112" => "ij",
            "113" => "inve",
            "116" => "jm",
            "120" => "kinv",
            "126" => "lato",
            "440" => "lifco",
            "129" => "loom",
            "130" => "lund",
            "131" => "lumi",
            "132" => "lupe",
            "135" => "meda",
            "138" => "melk",
            "143" => "mic",
            "148" => "mtg",
            "151" => "ncc",
            "156" => "nibe",
            "157" => "nobi",
            "249" => "noki",
            "159" => "nda",
            "171" => "ori",
            "738" => "pndx",
            "175" => "peab",
            "185" => "rato",
            "614" => "ratopref",
            "193" => "saab",
            "195" => "sand",
            "197" => "sca",
            "199" => "seb",
            "201" => "secu",
            "207" => "ska",
            "208" => "skf",
            "211" => "ssab",
            "212" => "ste",
            "217" => "swed",
            "218" => "swma",
            "219" => "sobi",
            "222" => "tel2",
            "223" => "tlsn",
            "224" => "tien",
            "229" => "trel",
            "238" => "wall",
            "236" => "volv"
        );

        $url = 'http://borsdata.se/progress/getHighChartJason';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);

        foreach($companies as $company_id => $company) {
            foreach($indices as $index => $name) {

                $data = array(
                    "companyID" => $company_id,
                    "selectedKPI" => $index
                );

                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

                $response = curl_exec($ch);
                $status = curl_getinfo($ch)['http_code'];

                if($status != 200) {
                    continue;
                }

                $kpi = json_decode($response)->KPIData;
                $kpi = $kpi[0];

                foreach($kpi->Data as $value) {

                    // Format date for the DATETIME mysql field
                    $year = strftime("%Y", $value->Year / 1000);
                    $date = date_create($value->Day . '-' . $value->Month . '-' . $year);
                    $date = date_format($date, 'Y-m-d H:i:s');

                    $instruments = Instrument::where('symbol', 'like', $company . '%')->get();

                    foreach ($instruments as $instrument) {
                        $instrument_meta = array(
                            "instrument_id" => $instrument->id,
                            "key" => $name,
                            "value" => $value->Value,
                            "created_at" => $date
                        );
                        $instrument_update = Metadata::firstOrCreate($instrument_meta);
                        $instrument_update->update($instrument_meta);
                    }

                }

            }
        }

        curl_close($ch);

        return "Success";
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