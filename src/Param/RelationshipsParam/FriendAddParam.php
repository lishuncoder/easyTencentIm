<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\RelationshipsParam;

use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendAdd\AddFriendItem;

class FriendAddParam
{
    /**
     * 必填
     * 需要为该 UserID 添加好友
     * @var string
     */
    public string $From_Account = '';

    /**
     * 必填
     * 消息接收方用户 UserID[]
     * @var AddFriendItem[]
     */
    public array $AddFriendItem = [];


    /**
     * 选填
     * 加好友方式（默认双向加好友方式）：
     * Add_Type_Single 表示单向加好友
     * Add_Type_Both 表示双向加好友
     * @var string|null
     */
    public ?string $AddType = 'Add_Type_Both';

    /**
     * 选填
     * 管理员强制加好友标记：1表示强制加好友，0表示常规加好友方式
     * @var int|null
     */
    public ?int $ForceAddFlags = 1;


}