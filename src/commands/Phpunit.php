<?php
namespace App\Commands;

use App\Traits\CommandInterface;

class Phpunit implements CommandInterface
{
    public static $name = "Phpunit";
    public static $subCommands = [];
    public function handle($message, $params)
    {
        $command =  "php {$_ENV['PHPUNIT_PATH']} --configuration {$_ENV['PHPUNITCONFIG_PATH']} {$_ENV['PHPUNIT_PARAMS']}";
        $handle = popen($command, 'r');
        $read = '';
        while(!feof($handle)){
            $read .=fgets($handle, 2096);
        }
        pclose($handle);
        return $read;
    }
}
