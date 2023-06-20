<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam;

class ModifyC2cMsgParam
{

    /**
     * 必填
     * 消息发送方 UserID
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
     * 必填
     * 修改消息的唯一标识。获取消息 MsgKey 的方法请参见本接口的接口说明
     *  - 开启 发单聊消息之前回调 或 发单聊消息之后回调，通过该回调接口记录每条单聊消息的 MsgKey 。
     *  - 通过 查询单聊消息 查询出待修改的单聊消息的 MsgKey 。
     *  - 通过 REST API 单发单聊消息 和 批量发单聊消息 接口发出的单聊消息，回包里会返回消息的 MsgKey 。
     * @var string
     */
    public string $MsgKey = '';


    /**
     * 选填
     * 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）
     * 一条组合消息中只能带一个 TIMCustomElem 自定义消息元素， 其它消息元素数量无限制。
     * @var ?|MsgBodyParam[]
     */
    public ?array $MsgBody;

    /**
     * 选填
     * 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @var string|null
     */
    public ?string $CloudCustomData = null;

}