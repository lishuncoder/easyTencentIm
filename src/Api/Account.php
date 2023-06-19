<?php
/**
 * User: liShun
 */

namespace Lishun\EasyTencentIm\Api;

use Exception;
use JsonException;
use Lishun\EasyTencentIm\Exception\TencentImException;
use GuzzleHttp\Exception\GuzzleException;

class Account extends Base
{

    protected string $version = 'v4';

    /**
     * 创建单个账号
     * @param string $unqId
     * @param string|null $nick
     * @param string|null $face
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function accountImport(
        string  $unqId = '',
        ?string $nick = null,
        ?string $face = null,
    ): array {
        $postData['UserID'] = $unqId;

        if ($nick !== null) {
            $postData['Nick'] = $nick;
        }

        if ($face !== null) {
            $postData['FaceUrl'] = $face;
        }

        $uri = '/v4/im_open_login_svc/account_import';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

    /**
     * 批量创建账号
     * 单次最多导入100个用户
     * @param array $unqIds
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function multiAccountImport(
        array $unqIds = [],
    ): array {

        $unqIds = array_map('strval', $unqIds);

        $postData['Accounts'] = $unqIds;


        $uri = '/v4/im_open_login_svc/multiaccount_import';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

    /**
     * 查询账号
     * @param array $unqIds
     * @return array|null
     * @throws GuzzleException
     * @throws TencentImException|JsonException
     */
    public function accountCheck(array $unqIds = []): ?array
    {
        if (empty($unqIds)) {
            throw new TencentImException('param must be not empty');
        }
        $ids = [];
        foreach ($unqIds as $id) {
            $ids[] = ['UserID' => (string)$id];
        }
        $postData = [
            'CheckItem' => $ids
        ];
        $uri = '/v4/im_open_login_svc/account_check';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

    /**
     * 查询单个账号
     * @param string $id
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function accountCheckOne(string $id = ''): array
    {
        if (empty($id)) {
            throw new TencentImException('param must be not empty');
        }

        $postData = [
            'CheckItem' => [
                ['UserId' => $id]
            ]
        ];
        $uri = '/v4/im_open_login_svc/account_check';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }

    /**
     * 删除账号
     * @param array $unqIds
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function accountDelete(array $unqIds = []): ?array
    {
        if (empty($unqIds)) {
            throw new TencentImException('checkAccount参数不能为空!');
        }
        $ids = [];
        foreach ($unqIds as $id) {
            $ids[] = ['UserID' => (string)$id];
        }
        $postData = [
            'DeleteItem' => $ids
        ];
        $uri = '/v4/im_open_login_svc/account_delete';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }


    /**
     * 查询账号在线状态
     * @param array $unqIds
     * @param int|null $needDetail
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function queryOnlineStatus(
        array $unqIds = [],
        ?int  $needDetail = null
    ): array {
        if (empty($unqIds)) {
            throw new TencentImException('checkOnlineByIds error');
        }
        $ids = [];
        foreach ($unqIds as $id) {
            $ids[] = (string)$id;
        }
        $postData = [
            'To_Account' => $ids
        ];
        if ($needDetail !== null) {
            $postData['IsNeedDetail'] = 1;
        }
        $uri = '/v4/openim/query_online_status';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }


    /**
     * 获取客户端普通用户登录的签名
     * @param string $unqId
     * @return string
     * @throws Exception
     */
    public function getLoginSign(string $unqId = ''): string
    {
        if (!$unqId || $unqId === $this->identifier) {
            throw new TencentImException('getLoginSign 参数错误');
        }
        return $this->getUserSign($unqId);
    }

    /**
     * 强制下线
     * @param string $unqId
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function kick(string $unqId = ''): ?array
    {
        $postData = [
            'UserID' => $unqId
        ];

        $uri = '/v4/im_open_login_svc/kick';
        return $this->postJsonRequest($this->buildGetData($uri), $postData);
    }
}
