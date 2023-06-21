<?php
declare(strict_types=1);

namespace Lishun\EasyTencentIm\Param\RecentContactParam;

use Lishun\EasyTencentIm\Param\RecentContactParam\CreateContactGroup\GroupContactItemParam;

class CreateContactGroupParam
{
    /**
     * 必填
     * 填 UserID，请求拉取该用户的会话列表
     * @var string
     */
    public string $From_Account = '';


    /**
     * 必填
     * 待添加的会话分组，当前仅支持单个添加
     * @var GroupContactItemParam
     */
    public GroupContactItemParam $GroupContactItem;
}