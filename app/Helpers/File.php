<?php

if (! function_exists('code')) {
    function code()
    {
        $code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12); 
	    return $code;
    }
}