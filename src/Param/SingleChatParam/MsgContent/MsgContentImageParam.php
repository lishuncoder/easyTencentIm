<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent;


use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentImage\ImageInfoArrayParam;

class MsgContentImageParam
{
//{
//    "MsgType": "TIMImageElem",
//    "MsgContent": {
//        "UUID": "1853095_D61040894AC3DE44CDFFFB3EC7EB720F",
//        "ImageFormat": 1,
//        "ImageInfoArrayParam": [
//            {
//                "Type": 1,           //原图
//                "Size": 1853095,
//                "Width": 2448,
//                "Height": 3264,
//                "URL": "http://xxx/3200490432214177468_144115198371610486_D61040894AC3DE44CDFFFB3EC7EB720F/0"
//            },
//            {
//                "Type": 2,      //大图
//                "Size": 2565240,
//                "Width": 0,
//                "Height": 0,
//                "URL": "http://xxx/3200490432214177468_144115198371610486_D61040894AC3DE44CDFFFB3EC7EB720F/720"
//            },
//            {
//                "Type": 3,   //缩略图
//                "Size": 12535,
//                "Width": 0,
//                "Height": 0,
//                "URL": "http://xxx/3200490432214177468_144115198371610486_D61040894AC3DE44CDFFFB3EC7EB720F/198"
//            }
//        ]
//    }
//}

    /**
     * 图片的唯一标识，客户端用于索引图片的键值。
     * @var ?string
     */
    public ?string $UUID = null;


    /**
     * 图片格式。JPG = 1，GIF = 2，PNG = 3，BMP = 4，其他 = 255。
     * @var ?int
     */
    public ?int $ImageFormat = null;


    /**
     * @var ImageInfoArrayParam[]|null
     */
    public ?array $ImageInfoArray = null;



}