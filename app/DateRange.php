<?php

namespace App;

use Carbon\Carbon;

class DateRange
{
    public $from;
    public $to;

    public static function date(String $date){
        return new DateRange($date);
    }

    public function __construct(String $date){
        $date1 = explode(' to ', $date)[0];
        $date2 = explode(' to ', $date)[1] ?? null;

        $this->from = Carbon::createFromFormat('d M, Y', $date1)->format('Y-m-d');
        $this->to = $date2
        ? Carbon::createFromFormat('d M, Y', $date2)->format('Y-m-d')
        : Carbon::createFromFormat('d M, Y', $date1)->format('Y-m-d');

    }

    public function from(){
        return $this->from;
    }

    public function to(){
        return $this->to;
    }
}
