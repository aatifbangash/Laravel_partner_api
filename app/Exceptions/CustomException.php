<?php

namespace App\Exceptions;

use Exception;
use Str;

/**
 * Custom exception created via make:exception command.
 */
class CustomException extends Exception
{

    protected $statusCode;
    protected $attribute;

    /**
     * use to receive the custom message and custom code
     */
    public function __construct($statusCode = 200, $message, $attribute = "")
    {
        parent::__construct($message, $statusCode);
        $this->code = $statusCode;
        $this->attribute = $attribute;
    }

    public function getCustomCode()
    {
        return $this->code;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    // this method call by `throw new CustomException("")`
    public function render($request)
    {
        return response()->json([
            "code" => Str::replace(" ", "_", Str::upper($this->getMessage())),
            "message" => $this->getMessage(),
            "attributeName" => $this->getAttribute()
        ], $this->getCustomCode());
    }
}