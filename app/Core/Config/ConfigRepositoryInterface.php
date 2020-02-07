<?php

namespace App\Core\Config;

interface ConfigRepositoryInterface
{
    public function getSiteConfigs();
    public function updateSiteConfigs($id,$name,$description);
    public function getCompanyName();
    public function getCompanyLogo();
}
