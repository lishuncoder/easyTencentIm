<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm;

use GuzzleHttp\ClientInterface;
use Lishun\EasyTencentIm\Api\Account;
use Lishun\EasyTencentIm\Api\Chat;
use Lishun\EasyTencentIm\Api\Friend;
use Lishun\EasyTencentIm\Api\Operating;
use Lishun\EasyTencentIm\Api\Profile;
use Lishun\EasyTencentIm\Api\RecentContact;
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
     * @return Account
     * @throws TencentImException
     */
    public function account(): Account
    {
        return (new Account($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }

    /**
     * @return Chat
     * @throws TencentImException
     */
    public function chat(): Chat
    {
        return (new Chat($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }

    /**
     * @return Operating
     * @throws TencentImException
     */
    public function operating(): Operating
    {
        return (new Operating($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }


    /**
     * @return Profile
     * @throws TencentImException
     */
    public function profile(): Profile
    {
        return (new Profile($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }

    /**
     * @return Friend
     * @throws TencentImException
     */
    public function friend(): Friend
    {
        return (new Friend($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }


    /**
     * @return RecentContact
     * @throws TencentImException
     */
    public function recentContact(): RecentContact
    {
        return (new RecentContact($this->appId, $this->appSecret, $this->baseUrl, $this->identifier))->setClient($this->client);
    }


}
