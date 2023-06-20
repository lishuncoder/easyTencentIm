<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentImage;

class ImageInfoArray
{

    /**
     * 图片类型： 1-原图，2-大图，3-缩略图。
     * @var ?int
     */
    public ?int $Type = null;

    /**
     * 图片数据大小，单位：字节。
     * @var ?int
     */
    public ?int $Size = null;

    /**
     * 图片宽度，单位为像素。
     * @var ?int
     */
    public ?int $Width = null;

    /**
     * 图片高度，单位为像素。
     * @var ?int
     */
    public ?int $Height = null;

    /**
     * 图片下载地址。
     * @var ?string
     */
    public ?string $URL = null;
}