<?php

namespace Lishun\EasyTencentIm\Param\MsgParam;



/**
 * 由于 APNs 推送限制数据包大小不能超过4K，因此除去其他控制字段，建议 Desc 和 Ext 字段之和不要超过3K。
 * OfflinePushInfo 是专用于离线推送配置的 JSON 对象，
 * 允许配置该条消息是否关闭推送、推送文本描述内容、推送透传字符串等。
 * 使用 OfflinePushInfo 可以方便地设置离线推送信息，无需再通过 TIMCustomElem 封装实现。
 *
 * 均为选填
 */
class SendChatOfflinePushInfoParam
{
    /**
     * 0表示推送，1表示不离线推送。
     * @var int|null
     */
    public ?int $PushFlag = null;

    /**
     * 离线推送标题。该字段为 iOS 和 Android 共用。
     * @var string|null
     */
    public ?string $Title = null;

    /**
     * 离线推送内容。该字段会覆盖上面各种消息元素 TIMMsgElement 的离线推送展示文本。
     * 若发送的消息只有一个 TIMCustomElem 自定义消息元素，该 Desc 字段会覆盖 TIMCustomElem 中的 Desc 字段。如果两个 Desc 字段都不填，将收不到该自定义消息的离线推送。
     * @var string|null
     */
    public ?string $Desc = null;

    /**
     * 离线推送透传内容。由于国内各 Android 手机厂商的推送平台要求各不一样，请保证此字段为 JSON 格式，否则可能会导致收不到某些厂商的离线推送。
     * @var string|null
     */
    public ?string $Ext = null;

    //未完成
    public ?array $AndroidInfo = null;

    //未完成
    public ?array $ApnsInfo = null;


}