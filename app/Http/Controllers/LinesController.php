<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cache;
use \Config;
class LinesController extends Controller
{
    private function getLinesStatus($id = null) {
        $baseURL = $id === null ? "https://api.tfl.gov.uk/line/mode/tube/status" : "https://api.tfl.gov.uk/line/$id/status";
        $api_id = Config::get('TFL_APP_ID');
        $api_key = Config::get('TFL_APP_KEY');
        $client = new \GuzzleHttp\Client();
        $res = $client->get($baseURL,
        [
            'auth' => [$api_id, $api_key]
        ]);
        return (string)$res->getBody();
    }
    private function getLines($id = null) {
        $cacheItem = $id === null ? 'lines' : 'line-' . $id;

        if($id === null) {
            $res = $this->getLinesStatus();
            Cache::put($cacheItem, $res);
        } else {
            if(Cache::has($cacheItem)) {
                $res = Cache::get($cacheItem);
            } else {
                $res = $this->getLinesStatus($id);
                Cache::put($cacheItem, $res, now()->addMinutes(5));
            }
        }

        return json_decode($res);
    }

    public function index() {
        $lines = $this->getLines();
        $timestamp = strtotime($lines[0]->modified);
        $updated = date('d/m/Y - H:s', $timestamp);

        return view('list', ['lines' => $lines, 'updated' => $updated]);
    }

    public function view($id) {
        $line = $this->getLines($id);
        $timestamp = strtotime($line[0]->modified);
        $updated = date('d/m/Y - H:s', $timestamp);

        return view('view', ['line' => $line[0], 'updated' => $updated]);
    }
}
