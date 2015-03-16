<?php

namespace jDateTime;


class Helper {
    /**
     * @param $year
     * @return bool
     */
    public function isLeapYear($year)
    {
        $a = 0.025;
        $b = 266;
        if ($year > 0) {
            $leapDays0 = (($year + 38) % 2820) * 0.24219 + $a;  // 0.24219 ~ extra days of one year
            $leapDays1 = (($year + 39) % 2820) * 0.24219 + $a;  // 38 days is the difference of epoch to 2820-year cycle
        } elseif ($year < 0) {
            $leapDays0 = (($year + 39) % 2820) * 0.24219 + $a;
            $leapDays1 = (($year + 40) % 2820) * 0.24219 + $a;
        } else {
            return false;
        }

        $frac0 = (int)(($leapDays0 - (int)$leapDays0) * 1000);
        $frac1 = (int)(($leapDays1 - (int)$leapDays1) * 1000);

        if ($frac0 <= $b && $frac1 > $b) {
            return true;
        } else {
            return false;
        }
    }
}