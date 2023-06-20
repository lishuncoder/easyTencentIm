<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm;

use GuzzleHttp\ClientInterface;
use Lishun\EasyTencentIm\Api\AccountApi;
use Lishun\EasyTencentIm\Api\SingleChatApi;
use Lishun\EasyTencentIm\Api\RelationshipsApi;
use Lishun\EasyTencentIm\Api\Operating;
use Lishun\EasyTencentIm\Api\PortraitApi;
use Lishun\EasyTencentIm\Api\RecentContactApi;
use Lishun\EasyTencentIm\Exception\TencentImException;

/**
 * Class TencentIm
 * @package TencentIm
 */
class TencentIm
{

    protected string $appId = '';
    protected string $appSecret = '';
    protected string $baseUrl = 'https://console.tim.qq.com';
    protected string $identifier = 'administrator';

    protected ?ClientInterface $client = null;


    /**
     * @param string $appId
     * @param string $appSecret
     * @param string $baseUrl
     * @param string $identifier
     * @param ClientInterface|null $client
     * @throws TencentImException
     */
    public function __construct(
        string           $appId = '',
        string           $appSecret = '',
        string           $baseUrl = '',
        string           $identifier = '',
        ?ClientInterface $client = null
    ) {
        if (!$appId || !$appSecret) {
            throw new TencentImException('appId,appSecret error');
        }
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $baseUrl && ($this->baseUrl = $baseUrl);
        $identifier && ($this->identifier = $identifier);
        $client && ($this->client = $client);
    }

    /**
     * @return AccountApi
     * @throws TencentImException
     */
    public function accountApi(): AccountApi
    {
        return new AccountApi($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }

    /**
     * @return SingleChatApi
     * @throws TencentImException
     */
    public function singleChatApi(): SingleChatApi
    {
        return new SingleChatApi($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }

    /**
     * @return Operating
     * @throws TencentImException
     */
    public function operating(): Operating
    {
        return new Operating($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }


    /**
     * @return PortraitApi
     * @throws TencentImException
     */
    public function portraitApi(): PortraitApi
    {
        return new PortraitApi($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }

    /**
     * @return RelationshipsApi
     * @throws TencentImException
     */
    public function relationshipsApi(): RelationshipsApi
    {
        return new RelationshipsApi($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }


    /**
     * @return RecentContactApi
     * @throws TencentImException
     */
    public function recentContactApi(): RecentContactApi
    {
        return new RecentContactApi($this->appId, $this->appSecret, $this->baseUrl, $this->identifier, $this->client);
    }


}
