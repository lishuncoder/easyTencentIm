<?php
declare(strict_types=1);
namespace Lishun\EasyTencentIm\Param\RelationshipsParam;


use Lishun\EasyTencentIm\Param\RelationshipsParam\FriendImport\AddFriendItemParam;

class FriendImportParam
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
     * @var AddFriendItemParam[]
     */
    public array $AddFriendItem = [];


    /**
     * 加好友方式（默认双向加好友方式）：
     * Add_Type_Single 表示单向加好友
     * Add_Type_Both 表示双向加好友
     * @var string|null
     */
    public ?string $AddType = null;


}