<?php

namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent;


/**
 * 录音消息
 */
class MsgContentSoundParam
{
    /**
     * 语音下载地址，可通过该 URL 地址直接下载相应语音。
     * @var string|null
     */
    public ?string $Url = null;

    /**
     * 语音的唯一标识，客户端用于索引语音的键值
     * @var string|null
     */
    public ?string $UUID = null;

    /**
     * 语音数据大小，单位：字节。
     * @var int|null
     */
    public ?int $Size = null;

    /**
     * 语音时长，单位：秒。
     * @var int|null
     */
    public ?int $Second = null;

    /**
     * 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音。
     * @var int|null
     */
    public ?int $Download_Flag = null;


}