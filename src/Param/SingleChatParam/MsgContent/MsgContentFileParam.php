<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent;


class MsgContentFileParam
{
    /**
     * 文件下载地址，可通过该 URL 地址直接下载相应文件。
     * @var string|null
     */
    public ?string $Url = null;

    /**
     * 文件的唯一标识，客户端用于索引文件的键值。
     * @var string|null
     */
    public ?string $UUID = null;

    /**
     * 文件数据大小，单位：字节。
     * @var int|null
     */
    public ?int $FileSize = null;

    /**
     * 文件名称。
     * @var string|null
     */
    public ?string $FileName = null;

    /**
     * 文件下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载文件。
     * @var int
     */
    public int $Download_Flag = 2;
}