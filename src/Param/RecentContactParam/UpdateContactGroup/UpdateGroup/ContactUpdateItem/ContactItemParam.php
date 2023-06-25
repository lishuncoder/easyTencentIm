<?php

namespace Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup\UpdateGroup\ContactUpdateItem;

class ContactItemParam
{

    /**
     * 必填
     * 会话类型，c2c=1,group=2
     * @var int
     */
    public int $Type = 1;

    /**
     * 必填
     * 群ID
     * @var string
     */
    public string $ToGroupId = '';

    /**
     * 必填
     * 用户ID
     * @var string
     */
    public string $To_Account = '';
}