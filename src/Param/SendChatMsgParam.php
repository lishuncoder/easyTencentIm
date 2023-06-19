<?php

namespace Lishun\EasyTencentIm\Param;

use Lishun\EasyTencentIm\Param\MsgParam\SendChatMsgBodyParam;
use Lishun\EasyTencentIm\Param\MsgParam\SendChatOfflinePushInfoParam;

class SendChatMsgParam
{
    /**
     * 选填
     * 1：把消息同步到 From_Account 在线终端和漫游上；
     * 2：消息不同步至 From_Account；
     * 若不填写默认情况下会将消息存 From_Account 漫游
     * @var ?int
     */
    public ?int $SyncOtherMachine = null;

    /**
     * 选填
     * 消息发送方 UserID（用于指定发送消息方账号）
     * @var ?string
     */
    public ?string $From_Account = null;


    /**
     * 必填
     * 消息接收方 UserID
     * @var string
     */
    public string $To_Account = '';

    /**
     * 选填
     * 消息离线保存时长（单位：秒），最长为7天（604800秒）
     * 若设置该字段为0，则消息只发在线用户，不保存离线
     * 若设置该字段超过7天（604800秒），仍只保存7天
     * 若不设置该字段，则默认保存7天
     * @var ?int
     */
    public ?int $MsgLifeTime = null;

    /**
     * 选填
     * 消息序列号（32位无符号整数），后台会根据该字段去重及进行同秒内消息的排序，详细规则请看本接口的功能说明。若不填该字段，则由后台填入随机数
     * @var int|null
     */
    public ?int $MsgSeq = null;

    /**
     * 必填
     * 消息随机数（32位无符号整数），后台用于同一秒内的消息去重。请确保该字段填的是随机
     * @var int
     */
    public int $MsgRandom = 0;

    /**
     * 选填
     * 消息回调禁止开关，只对本条消息有效
     * ForbidBeforeSendMsgCallback 表示禁止发消息前回调
     * ForbidAfterSendMsgCallback 表示禁止发消息后回调
     * ["ForbidBeforeSendMsgCallback","ForbidAfterSendMsgCallback"]
     *
     * @var array|null
     */
    public ?array $ForbidCallbackControl = null;

    /**
     * 选填
     * 消息发送控制选项，是一个 String 数组，只对本条消息有效。
     * "NoUnread"表示该条消息不计入未读数。
     * "NoLastMsg"表示该条消息不更新会话列表。
     * "WithMuteNotifications"表示该条消息的接收方对发送方设置的免打扰选项生效（默认不生效）
     * ["NoUnread","NoLastMsg","WithMuteNotifications"]
     * @var array|null
     */
    public ?array $SendMsgControl = null;

    /**
     * 必填
     * 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）
     * @var SendChatMsgBodyParam[]
     */
    public array $MsgBody;

    /**
     * 选填
     * 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @var string|null
     */
    public ?string $CloudCustomData = null;

    /**
     * 选填
     * 该条消息是否支持消息扩展，0为不支持，1为支持。
     * @var int|null
     */
    public ?int $SupportMessageExtension = null;

    /**
     * 选填
     * 离线推送信息配置，具体可参考 消息格式描述
     * @var SendChatOfflinePushInfoParam|null
     */
    public ?SendChatOfflinePushInfoParam $OfflinePushInfo = null;
}