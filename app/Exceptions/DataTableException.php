<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class DataTableException
 * @package App\Exceptions
 */
class DataTableException extends Exception
{
    /**
     * @var
     */
    public $message;

    /**
     * DataTableException constructor.
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
         * All instances of DataTableException redirect back with a flash message to show a bootstrap alert-error
         */
        return redirect()
            ->back()
            ->withFlashDanger($this->message);
    }

}