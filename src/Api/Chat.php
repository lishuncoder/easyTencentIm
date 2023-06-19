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
use Lishun\EasyTencentIm\Param\SendMsgParam\MsgBodyParam;
use Lishun\EasyTencentIm\Param\SendMsgParam\MsgContent\MsgContentCustomParam;
use Lishun\EasyTencentIm\Param\SendMsgParam\MsgContent\MsgContentLocationParam;
use Lishun\EasyTencentIm\Param\SendMsgParam\MsgContent\MsgContentTextParam;
use Lishun\EasyTencentIm\Param\SendMsgParam\MsgParam;
use Lishun\EasyTencentIm\Util\EasyTencentImHelper;

class Chat extends Base
{

    private int $isNeedReadReceipt = 0;

    public function setIsNeedReadReceipt(int $int): Chat
    {
        $this->isNeedReadReceipt = $int;
        return $this;
    }

    /**
     * 点对点单聊消息
     * @param MsgParam|array $msgParam
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendMsg(MsgParam|array $msgParam): array
    {
        if (is_array($msgParam)) {
            $postData = $msgParam;
            $body = $postData['MsgBody'];
            foreach ($body as $key => $value) {
                $body[$key]['IsNeedReadReceipt'] = $this->isNeedReadReceipt;
            }
            $postData = $body;
        } else {
            $body = $msgParam->MsgBody;
            foreach ($body as $value) {
                $value->IsNeedReadReceipt = $this->isNeedReadReceipt;
            }
            $msgParam->MsgBody = $body;
            $postData = EasyTencentImHelper::objFilterToArray($msgParam);
        }
        $uri = '/v4/openim/sendmsg';
        $authData = $this->buildGetData($uri);
        return $this->postJsonRequest($authData, $postData);
    }


    /**
     * 发送文本消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param string $text
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneTextMsg(
        string $fromUnqId = '',
        string $toUnqId = '',
        string $text = '',
    ): ?array {
        if (!$fromUnqId || !$toUnqId || !$text) {
            throw new TencentImException('文本消息参数错误');
        }
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMTextElem;
        $msgContentText = new MsgContentTextParam();
        $msgContentText->Text = $text;
        $msgBody->MsgContent = $msgContentText;
        $msgBody->IsNeedReadReceipt = $this->isNeedReadReceipt;

        $param = new MsgParam();
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->MsgBody = [$msgBody];

        return $this->sendMsg($param);
    }


    /**
     * 发送地理位置消息元素
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param float|MsgContentLocationParam $latitude
     * @param float $longitude
     * @param string $desc
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendOneLocationMsg(
        string                        $fromUnqId = '',
        string                        $toUnqId = '',
        float|MsgContentLocationParam $latitude = 0.000,
        float                         $longitude = 0.000,
        string                        $desc = '',
    ): ?array {
        if (!$fromUnqId || !$toUnqId) {
            throw new TencentImException('发送地理位置消息元素错误');
        }
        $msgBody = new MsgBodyParam();
        $msgBody->MsgType = MsgTypeConst::TIMLocationElem;
        $msgBody->IsNeedReadReceipt = $this->isNeedReadReceipt;

        $msgContentLocation = new MsgContentLocationParam();
        if ($latitude instanceof MsgContentLocationParam) {
            $msgContentLocation = $latitude;
        } else {
            $msgContentLocation->Latitude = $latitude;
            $msgContentLocation->Longitude = $longitude;
            $msgContentLocation->Desc = $desc;
        }

        $msgBody->MsgContent = $msgContentLocation;

        $param = new MsgParam();
        $param->From_Account = $fromUnqId;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->MsgBody = [$msgBody];

        return $this->sendMsg($param);
    }


    /**
     * 发送自定义消息
     * @param string $fromUnqId
     * @param string $toUnqId
     * @param MsgContentCustomParam|null $msgContent
     * @param int $syncOtherMachine 1：把消息同步到 From_Account 在线终端和漫游上；
     * 2：消息不同步至 From_Account；
     * 若不填写默认情况下会将消息存 From_Account 漫游
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     * @throws TencentImException
     */
    public function sendChatCustomMsg(
        string                 $fromUnqId = '',
        string                 $toUnqId = '',
        ?MsgContentCustomParam $msgContent = null,
        int                    $syncOtherMachine = 1
    ): ?array {
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
        $msgBody->IsNeedReadReceipt = 1;

        $param = new MsgParam();
        $param->From_Account = $fromUnqId;
        $param->SyncOtherMachine = $syncOtherMachine;
        $param->To_Account = $toUnqId;
        $param->MsgRandom = EasyTencentImHelper::randomNumberRange(100000, 99999999);
        $param->MsgBody = [$msgBody];  //可以一次性给一个人发多条

        return $this->sendMsg($param);
    }
}
