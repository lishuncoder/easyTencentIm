<?php

namespace Lishun\EasyTencentIm\Param\RecentContactParam\CreateContactGroup\GroupContactItem;

class ContactItemParam
{
    /**
     * 必填
     * 会话类型，c2c=1,group=2
     * @var int
     */
    public int $Type = 1;


    /**
     * 选填
     * 群ID
     * @var string|null
     */
    public ?string $ToGroupId = null;


    /**
     * 用户ID
     * 选填
     * 群ID
     * @var string|null
     */
    public ?string $To_Account = null;
}