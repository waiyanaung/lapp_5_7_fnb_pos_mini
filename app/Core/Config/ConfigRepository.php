<?php

namespace App\Core\Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Config\Config;

class ConfigRepository implements ConfigRepositoryInterface
{
    public function getSiteConfigs()
    {
        $configs = Config::whereNull('deleted_at')->get();
        return $configs;
    }

    public function updateSiteConfigs($id,$name,$description){
        $configs = Config::whereNull('deleted_at')->get();
        return $configs;
    }

    public function getCompanyName()
    {
        $tbConfig =  (new Config())->getTable();
        $configs = DB::select("SELECT * FROM $tbConfig WHERE code = 'SETTING_COMPANY_NAME'");
        return $configs;
    }

    public function getCompanyLogo()
    {
        $tbConfig =  (new Config())->getTable();
        $configs = DB::select("SELECT * FROM $tbConfig WHERE code = 'SETTING_LOGO'");
        return $configs;
    }

    public function getAdminEmails()
    {
        $tbConfig =  (new Config())->getTable();
        $configs = DB::select("SELECT * FROM $tbConfig WHERE code = 'SETTING_ADMIN_EMAILS'");
        return $configs;
    }

    public function getSiteActivationKey()
    {
        $tbConfig =  (new Config())->getTable();
        $configs = DB::select("SELECT * FROM $tbConfig WHERE code = 'SETTING_SITE_ACTIVATION_KEY'");
        return $configs;
    }

    public function getConfigByCode($code)
    {
        $tbConfig =  (new Config())->getTable();
        $configs = DB::select("SELECT * FROM $tbConfig WHERE code = '$code'");
        return $configs;
    }
}
