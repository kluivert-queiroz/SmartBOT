<?php
namespace App;
use Discord\DiscordCommandClient;

class Application
{
    protected $rootPath;
    protected $prefix = "!";
    /**
     * DiscordCommandClient
     *
     * @var \Discord\DiscordCommandClient 
     */
    protected $discord;
    public function __construct()
    {
        $this->rootPath = BASEPATH ."/";
        $this->loadEnvVariables();
        $this->boot();
    }
    /**
     * Boot necessary variables
     *
     * @return void
     */
    protected function boot()
    {
        $this->discord = $this->getDiscord();
    }
    /**
     * Load environment variables stored in .env
     *
     * @return void
     */
    protected function loadEnvVariables()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable($this->rootPath);
        $dotenv->load();
    }
    /**
     * Return current DiscordCommandClient
     *
     * @return \Discord\DiscordCommandClient
     */
    public function getDiscord()
    {
        if(!$this->discord)
            $this->discord = new DiscordCommandClient(
                [
                    'token'         => $_ENV["BOT_TOKEN"],
                    'prefix'        => $this->prefix,
                    'description'   => "Apenas um BOT"
                ]
            );
        return $this->discord;
    }
}
