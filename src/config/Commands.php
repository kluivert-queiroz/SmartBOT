<?php

namespace App\Config;

use App\Commands\Phpunit;
use App\Commands\Ping;

class Commands
{
    /**
     * Commands that will be registered
     *
     * @var array
     */
    public static $commands = [
        Ping::class,
        Phpunit::class,
    ];
    protected $app;
    protected $discord;
    public function __construct()
    {
        $this->app = $GLOBALS['app'];
        $this->discord = $this->app->getDiscord();
    }
    /**
     * Receives an array of commands and register them, 
     * if command have subcommands they will be registered too.
     *
     * @param  array $commands
     * 
     * @return void
     */
    public function registerCommands(array $commands)
    {
        
        foreach ($commands as $class) {
            $this->discord->registerCommand(
                strtolower($class::$name), function ($message, $params) use ($class) {
                    $command = new $class($message, $params);
                    return $command->handle($message, $params);
                }
            );
            if (count($class::$subCommands) > 0) {
                $this->registerCommands($class::$subCommands);
            }
        }
    }
    public static function __callStatic($name, $arguments)
    {
        if ($name === 'register') {
            $class = new Commands();
            return $class->registerCommands(Commands::$commands);
        }
    }
}
