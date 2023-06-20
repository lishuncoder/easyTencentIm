<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Constants;

class RelationshipsConst
{

    /**
     * 只将 To_Account 从 From_Account 的好友表中删除，但不会将 From_Account 从 To_Account 的好友表中删除
     */
    public const DeleteType_SINGLE = "Delete_Type_Single";

    /**
     * 将 To_Account 从 From_Account 的好友表中删除，同时将 From_Account 从 To_Account 的好友表中删除
     */
    public const DeleteType_BOTH = "Delete_Type_Both";



    /**
     * Add_Type_Single 表示单向加好友
     */
    public const AddType_Single = 'Add_Type_Single';

    /**
     * Add_Type_Both 表示双向加好友
     */
    public const AddType_Both = 'Add_Type_Both';



    /**
     * 只会检查 From_Account 的好友表中是否有 To_Account，不会检查 To_Account 的好友表中是否有 From_Account
     */
    public const CheckType_Single = 'CheckResult_Type_Single';

    /**
     * 既会检查 From_Account 的好友表中是否有 To_Account，也会检查 To_Account 的好友表中是否有 From_Account
     */
    public const CheckType_Both = 'CheckResult_Type_Both';



    /**
     * 只会检查 From_Account 的黑名单中是否有 To_Account，不会检查 To_Account 的黑名单中是否有 From_Account
     */
    public const BlackCheckTye_Single = 'BlackCheckResult_Type_Single';

    /**
     * 既会检查 From_Account 的黑名单中是否有 To_Account，也会检查 To_Account 的黑名单中是否有 From_Account
     */
    public const BlackCheckTye_Both = 'BlackCheckResult_Type_Both';


    /**
     * 是否需要拉取分组下的 User 列表, Need_Friend_Type_Yes: 需要拉取, 不填时默认不拉取, 只有 GroupName 为空时有效
     */
    public const  NeedFriend_Yes = 'Need_Friend_Type_Yes';

}