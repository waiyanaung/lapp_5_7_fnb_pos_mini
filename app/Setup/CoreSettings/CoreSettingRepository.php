<?php
/**
 * Created by Visual Studio Code.
 * User: User
 * Date: 7/17/2017
 * Time: 4:28 PM
 */

namespace App\Setup\CoreSettings;


class CoreSettingRepository implements CoreSettingRepositoryInterface
{
    public function getCancelReason($type){
        $result = Coresettings::select('value','description')->where('type',$type)->get();

        return $result;
    }
}