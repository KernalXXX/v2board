<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Protocols\General;
use App\Protocols\Singbox\Singbox;
use App\Protocols\Singbox\SingboxOld;
use App\Protocols\ClashMeta;
use App\Services\ServerService;
use App\Services\UserService;
use App\Utils\Helper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function subscribe(Request $request)
    {
        $client = new Client([
            'timeout' => 10,
            'http_errors' => false,
        ]);

        $response = $client->get($this->getConvertedSubscribeUrl($request), [
            'headers' => [
                'User-Agent' => $request->userAgent() ?: '',
            ],
        ]);
        $body = (string)$response->getBody();

        if (strpos($body, '#!MANAGED-CONFIG') === 0) {
            $body = preg_replace('/^#!MANAGED-CONFIG\s+\S+(.*)$/m', '#!MANAGED-CONFIG ' . $request->fullUrl() . '$1', $body, 1);
        }

        if ($response->getStatusCode() >= 400) {
            return $this->buildGeneralSubscribeResponse($request);
        }

        $headers = [];
        foreach ($response->getHeaders() as $key => $values) {
            if (in_array(strtolower($key), ['transfer-encoding', 'content-length', 'connection'])) continue;
            $headers[$key] = implode(', ', $values);
        }

        return response($body, $response->getStatusCode())->withHeaders($headers);
    }

    public function rawSubscribe(Request $request)
    {
        return $this->buildRawSubscribeResponse($request);
    }

    private function buildRawSubscribeResponse(Request $request)
    {
        $flag = $request->input('flag')
            ?? ($_SERVER['HTTP_USER_AGENT'] ?? '');
        $flag = strtolower($flag);
        $user = $request->user;
        // account not expired and is not banned.
        $userService = new UserService();
        if ($userService->isAvailable($user)) {
            $serverService = new ServerService();
            $servers = $serverService->getAvailableServers($user);
            if($flag) {
                if (!strpos($flag, 'sing')) {
                    $this->setSubscribeInfoToServers($servers, $user);
                    foreach (array_reverse(glob(app_path('Protocols') . '/*.php')) as $file) {
                        $file = 'App\\Protocols\\' . basename($file, '.php');
                        $class = new $file($user, $servers);
                        if (strpos($flag, $class->flag) !== false) {
                            return $class->handle();
                        }
                    }
                }
                if (strpos($flag, 'sing') !== false) {
                    $version = null;
                    if (preg_match('/sing-box\s+([0-9.]+)/i', $flag, $matches)) {
                        $version = $matches[1];
                    }
                    if (!is_null($version) && $version >= '1.12.0') {
                        $class = new Singbox($user, $servers);
                    } else {
                        $class = new SingboxOld($user, $servers);
                    }
                    return $class->handle();
                }
            }
            $class = new General($user, $servers);
            return $class->handle();
        }
    }

    private function buildGeneralSubscribeResponse(Request $request)
    {
        $user = $request->user;
        $userService = new UserService();
        if ($userService->isAvailable($user)) {
            $serverService = new ServerService();
            $servers = $serverService->getAvailableServers($user);
            $class = new General($user, $servers);
            return $class->handle();
        }
    }

    private function getConvertedSubscribeUrl(Request $request)
    {
        $path = config('v2board.subscribe_path', '/api/v1/client/subscribe');
        if (empty($path)) {
            $path = '/api/v1/client/subscribe';
        }

        $baseUrl = $request->getSchemeAndHttpHost();
        $rawUrl = $baseUrl . rtrim($path, '/') . '/raw/' . $request->route('token');

        return 'https://api.v1.mk/sub?' . http_build_query([
            'target' => 'auto',
            'udp' => 'true',
            'expand' => 'false',
            'filename' => 'SparkCloud',
            'config' => $baseUrl . '/static/sub.ini',
            'url' => $rawUrl,
        ], '', '&', PHP_QUERY_RFC3986);
    }

    private function setSubscribeInfoToServers(&$servers, $user)
    {
        if (!isset($servers[0])) return;
        if (!(int)config('v2board.show_info_to_server_enable', 0)) return;
        $useTraffic = $user['u'] + $user['d'];
        $totalTraffic = $user['transfer_enable'];
        $remainingTraffic = Helper::trafficConvert($totalTraffic - $useTraffic);
        $expiredDate = $user['expired_at'] ? date('Y-m-d', $user['expired_at']) : '长期有效';
        $userService = new UserService();
        $resetDay = $userService->getResetDay($user);
        array_unshift($servers, array_merge($servers[0], [
            'name' => "套餐到期：{$expiredDate}",
        ]));
        if ($resetDay) {
            array_unshift($servers, array_merge($servers[0], [
                'name' => "距离下次重置剩余：{$resetDay} 天",
            ]));
        }
        array_unshift($servers, array_merge($servers[0], [
            'name' => "剩余流量：{$remainingTraffic}",
        ]));
    }
}
