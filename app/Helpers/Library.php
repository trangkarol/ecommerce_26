<?php

namespace App\Helpers;

use DateTime;
use Mail;

class Library
{
    /**
    * get made in.
     *
     * @return category
     */
    public static function getMadeIn()
    {
        return [
            '0' => trans('common.made_in.chosse'),
            trans('common.made_in.china') => trans('common.made_in.china'),
            trans('common.made_in.vietname') => trans('common.made_in.vietname'),
            trans('common.made_in.usa') => trans('common.made_in.usa'),
            trans('common.made_in.japan') => trans('common.made_in.japan'),
            trans('common.made_in.italy') => trans('common.made_in.italy'),
        ];
    }

    /**
    * get getRatings
     *
     * @return category
     */
    public static function getRatings()
    {
        return [
            '0' => trans('common.rating.chosse'),
            '1' => trans('common.rating.one'),
            '2' => trans('common.rating.two'),
            '3' => trans('common.rating.three'),
            '4' => trans('common.rating.four'),
        ];
    }

    /**
    * get sort price
     *
     * @return category
     */
    public static function getSortPrice()
    {
        return [
            '0' => trans('common.price.sort'),
            '1' => trans('common.price.ascending'),
            '2' => trans('common.price.decrease'),
        ];
    }

    /**
    * get sort Product
     *
     * @return category
     */
    public static function getSortProduct()
    {
        return [
            '0' => trans('common.product.sort'),
            '1' => trans('common.product.hot'),
            '2' => trans('common.product.new'),
        ];
    }

    /**
    * get role
     *
     * @return category
     */
    public static function getRoles()
    {
        return [
            config('setting.role.admin') => trans('common.role.admin'),
            config('setting.role.user') => trans('common.role.user'),
        ];
    }

    /**
    * get status
     *
     * @return category
     */
    public static function getStatus()
    {
        return [
            '0' => trans('order.lbl-chosse'),
            config('setting.order_status.paid') => trans('order.lbl-paid'),
            config('setting.order_status.unpaid') => trans('order.lbl-unpaid'),
            config('setting.order_status.cancel') => trans('order.lbl-cancel'),
        ];
    }
}
