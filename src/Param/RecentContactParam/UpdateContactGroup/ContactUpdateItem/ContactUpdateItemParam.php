<?php

namespace Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup\ContactUpdateItem;

class ContactUpdateItemParam
{

    /**
     * 必填
     * 更新类型: 1 - 分组添加会话; 2 - 分组删除会话.
     * @var int
     */
    public int $ContactOptType = 1;

    /**
     * 必填
     * [To_Account=>Type]
     * @var array
     */
    public array $ContactItem = [];
}