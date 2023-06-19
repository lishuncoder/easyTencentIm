<?php

namespace Lishun\EasyTencentIm\Constants;

class FriendConst
{
    /**
     * 只将 To_Account 从 From_Account 的好友表中删除，但不会将 From_Account 从 To_Account 的好友表中删除
     */
    const DELETE_SINGLE = "Delete_Type_Single";

    /**
     * 将 To_Account 从 From_Account 的好友表中删除，同时将 From_Account 从 To_Account 的好友表中删除
     */
    const DELETE_BOTH = "Delete_Type_Both";

}