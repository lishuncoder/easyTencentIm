<?php
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Constants;

class PortraitConst
{
    // Tag_Profile_IM_Gender
    public const Tag_Profile_IM_Gender_Unknown = 'Gender_Type_Unknown';// 没设置性别
    public const Tag_Profile_IM_Gender_Male    = 'Gender_Type_Male';   // 男性
    public const Tag_Profile_IM_Gender_Female  = 'Gender_Type_Female'; // 女性

    /**
     * AllowType_Type_NeedConfirm：需要经过自己确认对方才能添加自己为好友
     */
    public const  Tag_Profile_IM_AllowType_NeedConfirm = 'AllowType_Type_NeedConfirm';

    /**
     * AllowType_Type_AllowAny：允许任何人添加自己为好友
     */
    public const  Tag_Profile_IM_AllowType_AllowAny = 'AllowType_Type_AllowAny';

    /**
     * AllowType_Type_DenyAny：不允许任何人添加自己为好友
     */
    public const  Tag_Profile_IM_AllowType_DenyAny = 'AllowType_Type_DenyAny';


    /**
     * AdminForbid_Type_None：默认值，允许加好友
     */
    public const Tag_Profile_IM_AdminForbidType_None = 'AdminForbid_Type_None';

    /**
     * AdminForbid_Type_SendOut：禁止该用户发起加好友请求
     */
    public const Tag_Profile_IM_AdminForbidType_SendOut = 'AdminForbid_Type_SendOut';

}