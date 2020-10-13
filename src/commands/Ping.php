<?php
namespace App\Commands;

use App\Traits\CommandInterface;

class Ping implements CommandInterface
{
    public static $name = "Ping";
    public static $subCommands = [];
    public function handle($message, $params)
    {
        return "Pong";
    }
}
