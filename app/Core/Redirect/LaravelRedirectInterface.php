<?php namespace App\Core\Redirect;
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/30/2016
 * Time: 2:52 PM
 */

interface LaravelRedirectInterface {

    public function firstRedirect();
    public function firstRedirectPath();
    public function afterAuthedRedirect();
}