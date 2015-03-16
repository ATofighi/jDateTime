<?php
/**
 * Author: AliReza Tofighi
 */

namespace jDateTime;

use DateTime;
use DateTimeZone;
use DateTimeInterface;
use DateInterval;
use jDateTime as jDate;

class jDateTime extends DateTime {
/*
    public function __construct($time = "now", DateTimeZone $timezone = null)
    {

    }
*/
    /**
     * @param $format
     * @return string
     */
    public function format($format) {
        $jDate = new jDate;
        $timestamp = $this->getTimestamp();
        $timezone = $this->getTimezone()->getName();

        $noChar = '_';
        while(strstr($format, $noChar))
        {
            $noChar .= '_';
        }
        preg_match_all("#\\\\([a-zA-Z ]{1})#s", $format, $match);
        $format = preg_replace("#\\\\([a-zA-Z ]{1})#s", $noChar, $format);


        $date = $jDate->date($format, $timestamp, false, null, $timezone);

        foreach($match[1] as $replace)
        {
            $date = str_replace($noChar, $replace, $date);
        }

        return $date;

    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->format(parent::ISO8601);
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return mixed
     */
    public function setDate($year, $month, $day)
    {
        $hour = $this->format("H");
        $minute = $this->format("i");
        $second = $this->format("s");

        $timestamp = jDate::mktime($hour, $minute, $second, $month, $day, $year, null, $this->getTimezone()->getName());
        $this->setTimestamp($timestamp);
        return $this;
    }

    /**
     * @param $year
     * @param $week
     * @param $day
     * @return mixed
     */
    public function setISODate($year, $week, $day)
    {
        $newDay = $week * 7 + $day;
        $month = 0;
        if($newDay <= 31 * 6)
        {
            $month += ceil($newDay/31);
            $day = $newDay % 31;
            if($day == 0)
            {
                $day = 31;
            }
        }
        else
        {
            $month += 6;
            $newDay -= 31 * 6;
            $month += ceil($newDay/30);
            $day = $newDay % 30;
            if($day == 0)
            {
                $day = 30;
            }
        }
        $this->setDate($year, $month, $day);
        return $this;
    }

    /**
     * @param $hour
     * @param $minute
     * @param $second
     * @return mixed
     */
    public function setTime($hour, $minute, $second)
    {
        parent::setTime($hour, $minute, $second);
        return $this;
    }

    /**
     * @param $unixtimestamp
     * @return mixed
     */
    public function setTimestamp($unixtimestamp)
    {
        parent::setTimestamp($unixtimestamp);
        return $this;
    }

    /**
     * @param DateTimeZone $timezone
     * @return mixed
     */
    public function setTimezone(DateTimeZone $timezone) {
        parent::setTimezone($timezone);
        return $this;
    }

    /**
     * @param DateInterval $interval
     * @return mixed
     */
    public function sub(DateInterval $interval)
    {
        parent:sub($interval);
        return $this;
    }
}