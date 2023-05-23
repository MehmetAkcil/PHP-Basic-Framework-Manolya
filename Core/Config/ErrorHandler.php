<?php

namespace Core\Config;

use Exception;

class ErrorHandler
{
    public string $contentType = 'json';

    private function exceptionHandlerHTML($exception): string
    {
        $errorMsg = "<style>.error-msg { background-color:#f1f1f1; color:#c0392b; padding:10px; margin:10px; }</style><div class='error-msg'>" .
            "<strong>Exception:</strong> " . $exception->getMessage() .
            "<br><strong>File:</strong> " . $exception->getFile() .
            "<br><strong>Line:</strong> " . $exception->getLine() .
            "</div>";
        return $errorMsg;
    }

    private function errorHandlerHTML($errno, $errstr, $errfile, $errline): string
    {
        $errorMsg = "<style>.error-msg { background-color:#f1f1f1; color:#c0392b; padding:10px; margin:10px; }</style><div class='error-msg'>" .
            "<strong>Error:</strong> [$errno] $errstr" .
            "<br><strong>File:</strong> $errfile" .
            "<br><strong>Line:</strong> $errline" .
            "</div>";
        return $errorMsg;
    }

    private function exceptionHandlerJSON($exception): false|string
    {
        $response = new Respond();
        return $response::responseServerError([
            'status' => false,
            'message' => $exception->getMessage(),
            'File' =>$exception->getFile(),
            'Line' => $exception->getLine()
        ]);
    }

    private function errorHandlerJSON($errNo, $errStr, $errFile, $errLine): false|string
    {
        $response = new Respond();
        return $response::responseServerError([
            'status' => false,
            'message' => $errNo . ' ' .$errStr,
            'File' =>$errFile,
            'Line' => $errLine
        ]);
    }

    public function exceptionHandler($exception): void
    {
        if($this->contentType != 'json'){
            echo $this->exceptionHandlerHTML($exception);
        }else{
            echo $this->exceptionHandlerJSON($exception);
        }
    }

    public function errorHandler($errNo, $errStr, $errFile, $errLine): void
    {
        if($this->contentType != 'json'){
            echo $this->errorHandlerHTML($errNo, $errStr, $errFile, $errLine);
        }else{
            echo $this->errorHandlerJSON($errNo, $errStr, $errFile, $errLine);
        }
    }
}