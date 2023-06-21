<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup;

use Lishun\EasyTencentIm\Param\RecentContactParam\UpdateContactGroup\ContactUpdateItem\ContactUpdateItemParam;

class UpdateGroupParam
{
    /**
     * 必填
     * 更新类型：1 - 更新分组名； 2 - 更新会话分组
     * @var int
     */
    public int $UpdateGroupType = 1;

    /**
     * 必填
     * 待更新的分组名
     * UpdateGroupType=1时，必填
     * @var string
     */
    public string $OldGroupName= '';

    /**
     * UpdateGroupType=1时，必填
     * 更新后的分组名，最多支持32个字节
     * @var string|null
     */
    public ?string $NewGroupName= '';

    /**
     * 必填
     * 待添加的会话列表
     * ['To_Account'=>'Type','To_Account'=>'Type']
     * @var null|ContactUpdateItemParam[]
     */
    public ?array $ContactUpdateItem = [];
}