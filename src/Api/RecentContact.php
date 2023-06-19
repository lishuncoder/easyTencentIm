<?php
/**
 * User: liShun
 */

namespace Lishun\EasyTencentIm\Api;


use Lishun\EasyTencentIm\Exception\TencentImException;
use Lishun\EasyTencentIm\Param\GetContactListParam;
use Lishun\EasyTencentIm\Param\GetOamMsgParam;
use App\Utils\ArrayHelper;
use App\Utils\EasyLog;
use GuzzleHttp\Exception\GuzzleException;

class RecentContact extends Base
{

    protected string $version = 'v4';

    /**
     * 分页拉取会话列表
     * @param GetContactListParam $contactListParam
     * @return array|null
     * @throws TencentImException
     */
    public function getContactList(GetContactListParam $contactListParam): ?array
    {
        try {
            $uri      = '/v4/recentcontact/get_list';
            $postData = myArrFilter(ArrayHelper::toArray($contactListParam));
            $authData = $this->buildGetData($uri);
            return $this->postJsonRequest($authData, $postData);
        } catch (\Throwable $e) {
            throw new TencentImException($e->getMessage());
        }
    }

    /**
     * 获取单聊消息
     * @param GetOamMsgParam $msgParam
     * @return array|null
     * @throws TencentImException
     */
    public function getOamMsg(GetOamMsgParam $msgParam): ?array
    {
        try {
            $uri      = '/v4/openim/admin_getroammsg';
            $postData = myArrFilter(ArrayHelper::toArray($msgParam));
            $authData = $this->buildGetData($uri);
            return $this->postJsonRequest($authData, $postData);
        } catch (\Throwable $e) {
            throw new TencentImException($e->getMessage());
        }
    }

    /**
     * 删除指定人的会话
     * @param string $fromImId
     * @param string $toImId
     * @param bool $deleteMsg true 清理漫游和本地（双删） false 清理本地（单删）
     * @return array|null
     * @throws TencentImException
     */
    public function deleteContactByImId(string $fromImId = '', string $toImId = '', bool $deleteMsg = false): ?array
    {
        try {
            $uri = '/v4/recentcontact/delete';

            if (!$fromImId || !$toImId) {
                throw new TencentImException('错误');
            }
            $postData = [
                'From_Account' => $fromImId,
                'Type'         => 1,
                'To_Account'   => $toImId,
                'ClearRamble'  => $deleteMsg ? 1 : 0
            ];
            EasyLog::new('recent-contact')->info('删除会话', [
                'postData' => $postData
            ]);
            $authData = $this->buildGetData($uri);
            return $this->postJsonRequest($authData, $postData);
        } catch (\Throwable $e) {
            throw new TencentImException($e->getMessage());
        }

    }


    /**
     * 获取单聊聊天记录
     * @param string $fromImId
     * @param string $toImId
     * @return array|null
     * @throws TencentImException
     */
    public function getRecentSingleContact(string $fromImId = '', string $toImId = ''): ?array
    {
        try {
            $uri = '/v4/openim/admin_getroammsg';

            if (!$fromImId || !$toImId) {
                throw new TencentImException('错误');
            }
            $postData = [
                'Operator_Account' => $fromImId,
                'Peer_Account'     => $toImId,
                'MaxCnt'           => 100,
                'MinTime'          => strtotime('-7days'),
                'MaxTime'          => strtotime('+3days'),
            ];
            $authData = $this->buildGetData($uri);
            return $this->postJsonRequest($authData, $postData);
        } catch (\Throwable $e) {
            throw new TencentImException($e->getMessage());
        }

    }
}
