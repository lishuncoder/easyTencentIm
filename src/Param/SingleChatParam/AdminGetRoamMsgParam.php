<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam;

class AdminGetRoamMsgParam
{
    /**
     * 必填
     * 会话其中一方的 UserID，以该 UserID 的角度去查询消息。同一个会话，分别以会话双方的角度去查询消息，结果可能会不一样，请参考本接口的接口说明
     * @var string
     */
    public string $Operator_Account = '';

    /**
     * 必填
     * 会话的另一方 UserID
     * @var string
     */
    public string $Peer_Account = '';

    /**
     * 必填
     * 请求的消息条数
     * @var int
     */
    public int $MaxCnt = 0;

    /**
     * 必填
     * 请求的消息时间范围的最小值（单位：秒）
     * @var int
     */
    public int $MinTime = 0;

    /**
     * 必填
     * 请求的消息时间范围的最大值（单位：秒）
     * @var int
     */
    public int $MaxTime = 0;

    /**
     * 选填
     * 上一次拉取到的最后一条消息的 MsgKey，续拉时需要填该字段，填写方法见上方
     * @var string|null
     */
    public ?string $LastMsgKey = '';

//{
//  "ActionStatus": "OK",
//  "ErrorInfo": "",
//  "ErrorCode": 0,
//  "Complete": 1,
//  "MsgCnt": 1,
//  "LastMsgTime": 1584669680,
//  "LastMsgKey": "549396494_2578554_1584669680",
//  "MsgList": [
//      {
//          "From_Account": "user1",
//          "To_Account": "user2",
//          "MsgSeq": 549396494,
//          "MsgRandom": 2578554,
//          "MsgTimeStamp": 1584669680,
//          "MsgFlagBits": 0,
//          "IsPeerRead": 0,
//          "MsgKey": "549396494_2578554_1584669680",
//          "MsgBody": [
//              {
//                  "MsgType": "TIMTextElem",
//                  "MsgContent": {
//                      "Text": "1"
//                  }
//              }
//          ],
//          "CloudCustomData": "your cloud custom data"
//      }
//  ]
//}

}