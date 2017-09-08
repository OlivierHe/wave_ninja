<?php
/**
 *  * User: Olivier Herzog
 * Date: 28/08/2017
 * Time: 18:28
 */

namespace App;



class DateGraber
{
    public $currentPastDate;

    public function __construct()
    {
        $this->currentPastDate = new \DateTime('@'.mktime(2,0,0,date("m"), date("d"), date("Y")));
    }

    public function getDates(){
        $pastDate = new \DateTime('@'.mktime(2, 0, 0, date("m")  , date("d"), date("Y")));
        $futurDate  = new \DateTime('@'.mktime(2, 0, 0, date("m")  , date("d")+5, date("Y")));
        $dateRange = new \DatePeriod($pastDate, new \DateInterval('PT3H'), $futurDate);

        return $dateRange;

    }
}



