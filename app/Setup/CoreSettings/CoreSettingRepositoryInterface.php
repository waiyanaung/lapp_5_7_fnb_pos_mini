<?php
/**
 * Created by Visual Studio Code.
 * User: User
 * Date: 7/17/2017
 * Time: 4:29 PM
 */

namespace App\Setup\CoreSettings;


interface CoreSettingRepositoryInterface
{
    public function getCancelReason($type);
}