<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\RecentContactParam\CreateContactGroup;

use Lishun\EasyTencentIm\Param\RecentContactParam\CreateContactGroup\GroupContactItem\ContactItemParam;

class GroupContactItemParam
{
    /**
     * 必填
     * 待添加的会话分组名称，最多32个字节
     * @var string
     */
    public string $GroupName = '';


    /**
     * 必填
     * 待添加的会话列表
     * @var ContactItemParam[]
     */
    public array $ContactItem = [];
}