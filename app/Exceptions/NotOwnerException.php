<?php

namespace App\Exceptions;

use Exception;

class NotOwnerException extends Exception
{
    public function render()
    {
    	return [
    		'errors' => 'Permission Denied'
    	];
    }
}
