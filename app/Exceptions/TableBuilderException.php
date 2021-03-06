<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class TableBuilderExceptionextends
 * @package App\Exceptions
 */
class TableBuilderException extends Exception
{
    /**
     * @var
     */
    public $message;

    /**
     * TableBuilderExceptionextends constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        /*
         * All instances of TableBuilderException redirect back with a flash message to show a bootstrap alert-error
         */
        return redirect()
            ->back()
            ->withFlashDanger($this->message);
    }

}