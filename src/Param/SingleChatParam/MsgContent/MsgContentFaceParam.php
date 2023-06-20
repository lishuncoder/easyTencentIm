<?php
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent;



class MsgContentFaceParam
{
    /**
     * 表情索引，用户自定义。
     * @var int|null
     */
    public ?int $Index = null;


    /**
     * 额外数据。
     * @var string|null
     */
    public ?string $Data = null;


}