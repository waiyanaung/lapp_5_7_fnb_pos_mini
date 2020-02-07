<?php
namespace App\Setup\Report;
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 5/25/2017
 * Time: 9:45 AM
 */
interface ReportRepositoryInterface
{
    public function saleSummaryReport($type=null, $from_date=null, $to_date=null);
    public function bookingReport($type=null, $from_date=null, $to_date=null, $status=null);
}