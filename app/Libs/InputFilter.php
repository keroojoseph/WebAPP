<?php

namespace App\Libs;

trait InputFilter
{
    public function filterInt($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public function filterString($input)
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }
}