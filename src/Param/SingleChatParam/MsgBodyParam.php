<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Param\SingleChatParam;


use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentCustomParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentFaceParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentFileParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentImageParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentLocationParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentSoundParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentTextParam;
use Lishun\EasyTencentIm\Param\SingleChatParam\MsgContent\MsgContentVideoParam;

class MsgBodyParam
{

    /**
     * 必填
     * TIM 消息对象类型，目前支持的消息对象包括：
     * TIMTextElem（文本消息）
     * TIMLocationElem（位置消息）
     * TIMFaceElem（表情消息）
     * TIMCustomElem（自定义消息）
     * TIMSoundElem（语音消息）
     * TIMImageElem（图像消息）
     * TIMFileElem（文件消息）
     * TIMVideoFileElem（视频消息）
     * @var string
     */
    public string $MsgType = '';

    /**
     * 消息体
     * eg：MsgContentCustomParam|MsgContentFaceParam
     * @var ?MsgContentCustomParam|MsgContentFaceParam|MsgContentLocationParam|MsgContentSoundParam|MsgContentTextParam|MsgContentImageParam|MsgContentFileParam|MsgContentVideoParam
     */
    public MsgContentCustomParam|MsgContentFaceParam|null|MsgContentImageParam|MsgContentTextParam|MsgContentSoundParam|MsgContentLocationParam|MsgContentFileParam|MsgContentVideoParam $MsgContent = null;


}