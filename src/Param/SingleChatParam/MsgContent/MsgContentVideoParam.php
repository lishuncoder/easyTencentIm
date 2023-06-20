<?php

namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent;


class MsgContentVideoParam
{
    /**
     * 视频下载地址。可通过该 URL 地址直接下载相应视频。
     * @var string|null
     */
    public ?string $VideoUrl = null;

    /**
     * 视频的唯一标识，客户端用于索引视频的键值。
     * @var string|null
     */
    public ?string $VideoUUID = null;

    /**
     * 视频数据大小，单位：字节。
     * @var int|null
     */
    public ?int $VideoSize = null;

    /**
     * 视频时长，单位：秒。Web 端不支持获取视频时长，值为0。
     * @var int|null
     */
    public ?int $VideoSecond = 0;

    /**
     * 视频格式，例如 mp4。
     * @var string|null
     */
    public ?string $VideoFormat = null;

    /**
     * 视频下载方式标记。目前 VideoDownloadFlag 取值只能为2，表示可通过VideoUrl字段值的 URL 地址直接下载视频。
     * @var int|null
     */
    public ?int $VideoDownloadFlag = 2;

    /**
     * 视频缩略图下载地址。可通过该 URL 地址直接下载相应视频缩略图。
     * @var string|null
     */
    public ?string $ThumbUrl = null;

    /**
     * 视频缩略图的唯一标识，客户端用于索引视频缩略图的键值。
     * @var string|null
     */
    public ?string $ThumbUUID = null;

    /**
     * 缩略图大小，单位：字节。
     * @var int|null
     */
    public ?int $ThumbSize = null;

    /**
     * 缩略图宽度，单位为像素。
     * @var int|null
     */
    public ?int $ThumbWidth = null;

    /**
     * 缩略图高度，单位为像素。
     * @var int|null
     */
    public ?int $ThumbHeight = null;

    /**
     * 缩略图格式，例如 JPG、BMP 等。
     * @var string|null
     */
    public ?string $ThumbFormat = null;

    /**
     * 视频缩略图下载方式标记。目前 ThumbDownloadFlag 取值只能为2，表示可通过ThumbUrl字段值的 URL 地址直接下载视频缩略图。
     * @var int|null
     */
    public ?int $ThumbDownloadFlag = 2;
}