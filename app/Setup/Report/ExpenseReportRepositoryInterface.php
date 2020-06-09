<?php
namespace App\Setup\Report;
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 6/8/2020
 * Time: 9:45 AM
 */
interface ExpenseReportRepositoryInterface
{
    public function summary($type=null, $from_date=null, $to_date=null);
}