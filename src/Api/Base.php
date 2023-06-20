<?php
/**
 * User: liShun
 */
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Lishun\EasyTencentIm\Exception\TencentImException;
use Tencent\TLSSigAPIv2;

class Base
{
    protected string $appId = '';
    protected string $appSecret = '';
    protected string $baseUrl = 'https://console.tim.qq.com';
    protected string $identifier = 'administrator';

    protected ?ClientInterface $client = null;

    /**
     * @throws TencentImException
     */
    public function __construct(
        string $appId = '',
        string $appSecret = '',
        string $baseUrl = '',
        string $identifier = '',
        ?ClientInterface $client = null
    ) {
        if (!$appId){
            throw new TencentImException('参数错误');
        }
        if (!$appSecret){
            throw new TencentImException('参数错误');
        }

        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $baseUrl && ($this->baseUrl = $baseUrl);
        $identifier && ($this->identifier = $identifier);
        $client && ($this->client = $client);
    }

    /**
     * @param string $unqId
     * @return string
     * @throws Exception
     */
    protected function getUserSign(string $unqId = ''): string
    {
        $api = new TLSSigAPIv2($this->appId, $this->appSecret);
        if ($unqId) {
            return $api->genUserSig($unqId);
        }
        return $api->genUserSig($this->identifier);
    }

    /**
     * @param string $uri
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function postJsonRequest(
        string $uri = '',
        array  $data = []
    ): array {

        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => $this->baseUrl,
                'timeout' => 20,
            ]);
        }

        $post = [
            'verify' => false, // 证书校验主动关闭
            'json' => $data
        ];

        $response = $this->client->request('POST', $uri, $post);
        $code = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $jsonData = json_encode($data, JSON_THROW_ON_ERROR);
        if ($code !== 200) {
            throw new TencentImException('TencentIm Network Error: ' . $uri . ',code:' . $code . ',data:' . $jsonData);
        }
        $jsonRes = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        if ($jsonRes && is_array($jsonRes) && ($jsonRes['ErrorCode'] === 0)) {
            return $jsonRes;
        }
        throw new TencentImException($body);
    }


    /**
     * @param string $uri
     * @param array $data
     * @return string
     * @throws TencentImException
     */
    public function buildGetData(
        string $uri = '',
        array  $data = []
    ): string {
        try {
            $uri .= '?';
            mt_rand();
            $getData = [
                'sdkappid' => $this->appId,
                'identifier' => $this->identifier,
                'usersig' => $this->getUserSign(),
                'random' => random_int(0, 4294967295),
                'contenttype' => 'json'
            ];
            $getData = array_merge($getData, $data);
            $getData = http_build_query($getData);
            return $uri . $getData;
        } catch (\Throwable $throwable) {
            throw new TencentImException($throwable->getMessage() . ',trace:' . $throwable->getTraceAsString());
        }
    }


}
