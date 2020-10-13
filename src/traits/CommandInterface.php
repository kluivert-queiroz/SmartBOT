<?php
namespace App\Traits;

interface CommandInterface
{
    /**
     * Receives a command and return its response
     *
     * @param \Discord\Parts\Channel\Message $message
     * @param array                          $params
     * 
     * @return void
     */
    public function handle($message, $params);
}
