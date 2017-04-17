<?php

namespace App\Helpers;

use DateTime;
use Mail;
use Cache;

class Library
{
    /**
    * get made in.
     *
     * @return category
     */
    public static function getMadeIn()
    {
        $madeIn = [
            '0' => trans('common.made_in.chosse'),
            '1' => trans('common.made_in.china'),
            '2' => trans('common.made_in.vietname'),
            '3' => trans('common.made_in.usa'),
            '4' => trans('common.made_in.japan'),
            '5' => trans('common.made_in.italy'),
        ];

        return $madeIn;
    }
}
