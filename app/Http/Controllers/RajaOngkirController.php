<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreInfo;

class RajaOngkirController extends Controller
{
    private function curlInitialize($url, $method, $fields){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . env("RAJA_ONGKIR_API_KEY", "")
            ),
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function get_province(){        
        $province = $this->curlInitialize("https://api.rajaongkir.com/starter/province", "GET", null)->rajaongkir->results;

        return $province;
    }

    public function get_city_by_province($id){
        $cities = $this->curlInitialize("https://api.rajaongkir.com/starter/city?province=" . $id, "GET", null)->rajaongkir->results;

        return $cities;
    }

    public function get_cost(Request $req){
        $storeinfo = StoreInfo::find(1);
        $origin = $storeinfo->city_code;
        $destination = $req->destination;
        $weight = $req->weight;
        $courier = $req->courier;
        // return $req;

        $fields = "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier;
        $cost = $this->curlInitialize("https://api.rajaongkir.com/starter/cost", "POST", $fields)->rajaongkir->results;
        return $cost;
    }
}
