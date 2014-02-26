<?php
namespace DoctrineMigrationsHelper;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Connection;


/**
 * CommandSet Class
 *
 * Acts as a helper to produce console ready commands from a custom Migrations Configuration
 *
 * @author Ross Riley <riley.ross@gmail.com>
 **/
class CommandSet
{

    public $commands = [
        "Diff",
        "Execute",
        "Generate",
        "Latest",
        "Migrate",
        "Status",
        "Version"
    ];

    public $configuration;

    /**
     * Constructor
     * @param $connection - Requires a Doctrine DBAL Connection
     **/
    public function __construct(Connection $connection, $namespace = false, $directory = false)
    {
        $this->configuration = new Configuration($connection);
    }


    /**
     * getCommands function
     *
     * @return Array[Command]
     **/
    public function getCommands() {
        $commands = [];
        foreach($this->commands as $command) {
            $class = "Doctrine\DBAL\Migrations\Tools\Console\Command\\".$command."Command";
            $obj = new $class;
            $obj->setMigrationConfiguration($this->configuration);
            $commands[]=$obj;
        }
        return $commands;
    }

}