<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam\OfflinePushInfo;

class AndroidInfoParam
{
    /**
     * 选填
     * Android 离线推送声音文件路径。
     * @var string|null
     */
    public ?string $Sound = null;

    /**
     * 选填
     * 华为手机 EMUI 10.0 及以上的通知渠道字段。该字段不为空时，会覆盖控制台配置的 ChannelID 值；该字段为空时，不会覆盖控制台配置的 ChannelID 值。
     * @var string|null
     */
    public ?string $HuaWeiChannelID = null;

    /**
     * 选填
     * 小米手机 MIUI 10 及以上的通知类别（Channel）适配字段。该字段不为空时，会覆盖控制台配置的 ChannelID 值；该字段为空时，不会覆盖控制台配置的 ChannelID 值。
     * @var string|null
     */
    public ?string $XiaoMiChannelID = null;

    /**
     * 选填
     * OPPO 手机 Android 8.0 及以上的 NotificationChannel 通知适配字段。该字段不为空时，会覆盖控制台配置的 ChannelID 值；该字段为空时，不会覆盖控制台配置的 ChannelID 值。
     * @var string|null
     */
    public ?string $OPPOChannelID = null;

    /**
     * 选填
     * Google 手机 Android 8.0 及以上的通知渠道字段。Google 推送新接口（上传证书文件）支持 channel id，旧接口（填写服务器密钥）不支持。
     * @var string|null
     */
    public ?string $GoogleChannelID = null;

    /**
     * 选填
     * VIVO 手机推送消息分类，“0”代表运营消息，“1”代表系统消息，不填默认为1。(VIVO 推送服务于 2023 年 4 月 3 日优化消息分类规则，推荐使用 AndroidInfo.VIVOCategory 设置消息类别)
     * @var int|null
     */
    public ?int $VIVOClassification = null;

    /**
     * 选填
     * VIVO 手机用来标识消息类型，该字段不为空时，会覆盖控制台配置的 category 值；该字段为空时，不会覆盖控制台配置的 category 值。详见 category 描述 。
     * https://dev.vivo.com.cn/documentCenter/doc/359
     * @var string|null
     */
    public ?string $VIVOCategory = null;

    /**
     * 选填
     * 华为推送通知消息分类，取值为 LOW、NORMAL，不填默认为 NORMAL。
     * @var string|null
     */
    public ?string $HuaWeiImportance = null;

    /**
     * 选填
     * 在控制台配置华为推送为“打开应用内指定页面”的前提下，传“1”表示将透传内容 Ext 作为 Intent 的参数，“0”表示将透传内容 Ext 作为 Action 参数。不填默认为0。两种传参区别可参见 华为推送文档。
     * https://developer.huawei.com/consumer/cn/doc/development/HMSCore-Guides/andorid-basic-clickaction-0000001087554076#section20203190121410
     * @var int|null
     */
    public ?int $ExtAsHuaweiIntentParam = null;

    /**
     * 选填
     * 华为手机用来标识消息类型，该字段不为空时，会覆盖控制台配置的 category 值；该字段为空时，不会覆盖控制台配置的 category 值。详见 category 描述。
     * https://developer.huawei.com/consumer/cn/doc/development/HMSCore-References/https-send-api-0000001050986197#section13271045101216
     * @var string|null
     */
    public ?string $HuaWeiCategory = null;
}