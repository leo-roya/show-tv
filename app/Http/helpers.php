<?php

function checkPermission($permissions)
{
    if(Auth::check())
    {
        foreach($permissions as $key=>$value)
        {
            if($value == auth()->user()->role)
                return true;
        }
    }
    return false;
}

