<?php
/**
 *  * User: Olivier Herzog
 * Date: 28/08/2017
 * Time: 18:28
 */

namespace App;


class DateGraber
{
    public function getDates(){
        // 2017-08-01T21:00:00Z
        // $todayDate = date('Y-m-d'); //H:i:s', time());
        $futurDate  = new \DateTime('@'.mktime(2, 0, 0, date("m")  , date("d")+6, date("Y")));
        $pastDate = new \DateTime('@'.mktime(2, 0, 0, date("m")  , date("d")-29, date("Y")));
        $dateRange = new \DatePeriod($pastDate, new \DateInterval('PT3H'), $futurDate);

        return $dateRange;


       /* foreach($dateRange as $date){
            //echo $date->format("Y-m-d"). "<br>";
           echo $date->format("Y-m-d\TH:i:s\Z"). "<br>";
        }*/

    }
}



