<?php

namespace Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup\UpdateGroup;

use Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup\UpdateGroup\ContactUpdateItem\ContactItemParam;

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
     * @var ContactItemParam[]
     */
    public array $ContactItem = [];
}