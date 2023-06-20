<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam;

class ImportMsgParam
{

    /**
     * 必填
     * 该字段只能填2或5，其他值是非法值
     * 2表示历史消息导入，消息不计入未读计数，且消息不会推送到终端
     * 5表示实时消息导入，消息计入未读计数，且消息会推送到终端
     * @var int
     */
    public int $SyncFromOldSystem = 5;

    /**
     * 必填
     * 消息发送方 UserID（用于指定发送消息方账号）
     * @var string
     */
    public string $From_Account = '';

    /**
     * 必填
     * 消息接收方 UserID
     * @var string
     */
    public string $To_Account = '';


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
     * 必填
     * 消息时间戳，UNIX 时间戳，单位为秒。后台会根据该字段去重，详细规则请看本接口的功能说明。
     * @var int
     */
    public int $MsgTimeStamp = 0;


    /**
     * 必填
     * 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）
     * 一条组合消息中只能带一个 TIMCustomElem 自定义消息元素， 其它消息元素数量无限制。
     * @var MsgBodyParam[]
     */
    public array $MsgBody;


    /**
     * 选填
     * 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @var string|null
     */
    public ?string $CloudCustomData = null;
}