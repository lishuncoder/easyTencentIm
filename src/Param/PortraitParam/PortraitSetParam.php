<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\PortraitParam;


/**
 * [用户资料与关系链] 标配资料字段
 */
class PortraitSetParam
{
    /**
     *   昵称
     * max !< 500
     * @var string|null
     */
    public ?string $Tag_Profile_IM_Nick = null;

    /**
     *    性别
     * Gender_Type_Unknown：没设置性别
     * Gender_Type_Female：女性
     * Gender_Type_Male：男性
     * @var string|null
     */
    public ?string $Tag_Profile_IM_Gender = null;

    /**
     *    生日
     * 推荐用法：20190419
     * @var int|null
     */
    public ?int $Tag_Profile_IM_BirthDay = null;

    /**
     *    所在地
     * 长度不得超过16个字节，推荐用法如下：
     * App 本地定义一套数字到地名的映射关系
     * 后台实际保存的是4个 uint32_t 类型的数字
     * 其中第一个 uint32_t 表示国家
     * 第二个 uint32_t 用于表示省份
     * 第三个 uint32_t 用于表示城市
     * 第四个 uint32_t 用于表示区县
     * @var string|null
     */
    public ?string $Tag_Profile_IM_Location = null;

    /**
     *    个性签名
     * max !< 500
     * @var string|null
     */
    public ?string $Tag_Profile_IM_SelfSignature = null;

    /**
     *  加好友验证方式
     * AllowType_Type_NeedConfirm：需要经过自己确认对方才能添加自己为好友
     * AllowType_Type_AllowAny：允许任何人添加自己为好友
     * AllowType_Type_DenyAny：不允许任何人添加自己为好友
     * @var string|null
     */
    public ?string $Tag_Profile_IM_AllowType = null;

    /**
     *   语言
     * App 本地定义数字与语言的映射关系，需要 App 本地将语言对应的数字转换为文字
     * @var int|null
     */
    public ?int $Tag_Profile_IM_Language = null;

    /**
     *    头像URL
     * 长度不得超过500个字节
     * @var string|null
     */
    public ?string $Tag_Profile_IM_Image = null;

    /**
     *  管理员禁止加好友标识
     * AdminForbid_Type_None：默认值，允许加好友
     * AdminForbid_Type_SendOut：禁止该用户发起加好友请求
     * @var string|null
     */
    public ?string $Tag_Profile_IM_AdminForbidType = null;

    /**
     *  等级
     * @var int|null
     */
    public ?int $Tag_Profile_IM_Level = null;

    /**
     *  角色
     * @var int|null
     */
    public ?int $Tag_Profile_IM_Role = null;

}