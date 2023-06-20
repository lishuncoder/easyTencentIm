<?php
/**
 * User: liShun
 */
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Api;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Lishun\EasyTencentIm\Constants\MsgTypeConst;
use Lishun\EasyTencentIm\Exception\TencentImException;
use Lishun\EasyTencentIm\Param\SingleChatParam\AdminGetRoamMsgParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\BatchMsgParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\ImportMsgParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\ModifyC2cMsgParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgBodyParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentCustomParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentFaceParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentFileParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentImageParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentLocationParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentSoundParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentTextParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentVideoParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\SendMsgParam;
use Lishun\EasyTencentIm\Util\EasyTencentImHelper;

class SingleChatApi extends Base
{

    /**
     * 点对点单聊消息
     * @param SendMsgParam|array $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendMsg(SendMsgParam|array $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($msgParam));
        }
        $uri = '/v4/openim/sendmsg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 发送单条文本消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param string $text
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneTextMsg(
        string $fromUnqId = '',
        string $toUnqId = '',
        string $text = '',
        int    $isNeedReadReceipt = 0,
        int    $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$text) {
            throw new TencentImException('文本消息参数错误');
        }
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMTextElem;
        $msgContentText = new MsgContentTextParam();
        $msgContentText->Text = $text;
        $msgBody->MsgContent = $msgContentText;

        $param = new SendMsgParam();
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->MsgBody = [$msgBody];
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;

        return $this->sendMsg($param);
    }


    /**
     * 发送单条地理位置消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentLocationParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneLocationMsg(
        string                   $fromUnqId = '',
        string                   $toUnqId = '',
        ?MsgContentLocationParam $contentParam = null,
        int                      $isNeedReadReceipt = 0,
        int                      $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条地理位置消息');
        }

        //请求参数基本设置
        $param = new SendMsgParam();
        $param->To_Account = $toUnqId;
        $param->From_Account = $fromUnqId;
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMLocationElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        $param->MsgBody = [$msgBody];
        return $this->sendMsg($param);
    }


    /**
     * 发送单条表情消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentFaceParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneFaceMsg(
        string               $fromUnqId = '',
        string               $toUnqId = '',
        ?MsgContentFaceParam $contentParam = null,
        int                  $isNeedReadReceipt = 0,
        int                  $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条表情消息错误');
        }

        //请求参数基本设置
        $param = new SendMsgParam();
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMFaceElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        $param->MsgBody = [$msgBody];
        return $this->sendMsg($param);
    }

    /**
     * 发送单条语音消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentSoundParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneSoundMsg(
        string                $fromUnqId = '',
        string                $toUnqId = '',
        ?MsgContentSoundParam $contentParam = null,
        int                   $isNeedReadReceipt = 0,
        int                   $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条语音消息错误');
        }

        //请求参数基本设置
        $param = new SendMsgParam();
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->From_Account = $fromUnqId;
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMSoundElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        $param->MsgBody = [$msgBody];
        return $this->sendMsg($param);
    }

    /**
     * 发送单条图像消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentImageParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneImageMsg(
        string                $fromUnqId = '',
        string                $toUnqId = '',
        ?MsgContentImageParam $contentParam = null,
        int                   $isNeedReadReceipt = 0,
        int                   $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条图像消息错误');
        }

        //请求参数基本设置
        $param = new SendMsgParam();
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100001, 99999999);
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMImageElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        $param->MsgBody = [$msgBody];
        return $this->sendMsg($param);
    }


    /**
     * 发送单条文件消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentFileParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneFileMsg(
        string               $fromUnqId = '',
        string               $toUnqId = '',
        ?MsgContentFileParam $contentParam = null,
        int                  $isNeedReadReceipt = 0,
        int                  $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条文件消息错误');
        }

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMFileElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        //请求参数基本设置
        $param = new SendMsgParam();
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100001, 99999999);
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgBody = [$msgBody];
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;

        return $this->sendMsg($param);
    }

    /**
     * 发送单条视频消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentVideoParam|null $contentParam
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneVideoMsg(
        string                $fromUnqId = '',
        string                $toUnqId = '',
        ?MsgContentVideoParam $contentParam = null,
        int                   $isNeedReadReceipt = 0,
        int                   $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$contentParam) {
            throw new TencentImException('发送单条视频消息错误');
        }

        //构造消息体
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMVideoFileElem;
        $msgBody->MsgContent = $contentParam;

        //设置消息体
        //请求参数基本设置
        $param = new SendMsgParam();
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100001, 99999999);
        $param->To_Account = $toUnqId;
        $param->From_Account = $fromUnqId;
        $param->MsgBody = [$msgBody];
        $param->IsNeedReadReceipt = $isNeedReadReceipt;
        $param->SyncOtherMachine = $syncOtherMachine;
        return $this->sendMsg($param);
    }


    /**
     * 发送自定义消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentCustomParam|null $msgContent
     * @param int $isNeedReadReceipt
     * @param int $syncOtherMachine 1：把消息同步到 From_Account 在线终端和漫游上；
     * 2：消息不同步至 From_Account；
     * 若不填写默认情况下会将消息存 From_Account 漫游
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneCustomMsg(
        string                 $fromUnqId = '',
        string                 $toUnqId = '',
        ?MsgContentCustomParam $msgContent = null,
        int                    $isNeedReadReceipt = 0,
        int                    $syncOtherMachine = 1,
    ): array {
        if (!$fromUnqId || !$toUnqId || !$msgContent) {
            throw new TencentImException('自定义消息参数错误');
        }
        if (!$msgContent->Data || !$msgContent->Desc) {
            throw new TencentImException('自定义消息参数错误,消息体错误');
        }
        //透传保证消息下放
        $msgContent->Ext = $msgContent->Ext ?: $msgContent->Data;

        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMCustomElem;
        $msgBody->MsgContent = $msgContent;

        $param = new SendMsgParam();
        $param->From_Account = $fromUnqId;
        $param->SyncOtherMachine = $syncOtherMachine;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->MsgBody = [$msgBody];  //可以一次性给一个人发多条
        $param->IsNeedReadReceipt = $isNeedReadReceipt;

        return $this->sendMsg($param);
    }


    /**
     * 批量发单聊消息
     * @param array|BatchMsgParam $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function batchSendMsg(array|BatchMsgParam $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($msgParam));
        }
        $uri = '/v4/openim/batchsendmsg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 导入单聊消息
     * @param ImportMsgParam|array $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function importMsg(ImportMsgParam|array $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($msgParam));
        }
        $uri = '/v4/openim/importmsg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 管理员查询单聊消息
     * @param AdminGetRoamMsgParam|array $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function adminGetRoamMsg(AdminGetRoamMsgParam|array $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($msgParam));
        }
        $uri = '/v4/openim/admin_getroammsg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 管理员撤回单聊消息
     * @param string $fromId
     * @param string $toId
     * @param string $msgKey
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function adminMsgWithdraw(
        string $fromId,
        string $toId,
        string $msgKey
    ): array {
        $postData = [
            'From_Account' => $fromId,
            'To_Account' => $toId,
            'MsgKey' => $msgKey
        ];
        $uri = '/v4/openim/admin_msgwithdraw';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 设置单聊消息已读
     * @param string $Report_Account
     * @param string $Peer_Account
     * @param string|null $MsgReadTime 时间戳（秒），该时间戳之前的消息全部已读。若不填，则取当前时间戳
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function adminSetMsgRead(
        string  $Report_Account,
        string  $Peer_Account,
        ?string $MsgReadTime = null
    ): array {
        $postData = [
            'Report_Account' => $Report_Account,
            'Peer_Account' => $Peer_Account,
        ];
        if ($MsgReadTime !== null) {
            $postData['MsgReadTime'] = $MsgReadTime;
        }
        $uri = '/v4/openim/admin_set_msg_read';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 查询单聊未读消息计数
     * @param string $To_Account
     * @param array|null $Peer_Account
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function getC2cUnreadMsgNum(
        string $To_Account,
        ?array $Peer_Account = null,
    ): array {
        $postData = [
            'To_Account' => $To_Account,
        ];
        if ($Peer_Account !== null) {
            $postData['Peer_Account'] = $Peer_Account;
        }
        $uri = '/v4/openim/get_c2c_unread_msg_num';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }

    /**
     * 修改单聊历史消息
     * @param ModifyC2cMsgParam|array $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function modifyC2cMsg(ModifyC2cMsgParam|array $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
        } else {
            $postData = EasyTencentImHelper::arrayFilter(EasyTencentImHelper::toArray($msgParam));
        }
        $uri = '/v4/openim/modify_c2c_msg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }
}
