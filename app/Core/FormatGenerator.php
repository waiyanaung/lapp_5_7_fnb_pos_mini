<?php namespace App\Core;
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 7/20/2016
 * Time: 10:34 AM
 */

class FormatGenerator {

    //create notification params.
    public static function message($status, $body)
    {
        return ['status'=>$status, 'body'=>$body];
    }

}
