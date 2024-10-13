<?php

namespace App\Helpers;

use NumberFormatter;



class Currency {

    public static function format($amount , $currency = Null)
    {
        $formater = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);

        if ($currency === null) {

            return $formater->formatCurrency($amount,config('app.currency'));
        }

        return $formater->formatCurrency($amount,$currency );
    }




}

