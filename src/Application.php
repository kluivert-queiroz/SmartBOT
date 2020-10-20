<?php
namespace App;
use Discord\DiscordCommandClient;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
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

    /**
     * Logger
     *
     * @var Monolog\Logger
     */
    protected $logger;
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
        if(!$this->discord) {
            $this->discord = new DiscordCommandClient(
                [
                    'token'         => $_ENV["BOT_TOKEN"],
                    'prefix'        => $this->prefix,
                    'description'   => "Apenas um BOT",
                    'discordOptions' => [
                        'logger'    => $this->getLogger(),
                    ]
                ]
            );
        }
        return $this->discord;
    }
    /**
     * Get actual logger
     *
     * @return Monolog\Logger
     */
    public function getLogger()
    {
        if(!$this->logger) {
            $this->logger = new Logger('bot');
            $this->logger->pushHandler(
                new StreamHandler(BASEPATH . "/storage/log.log", Logger::INFO)
            );
        }
        return $this->logger;
    }
}
