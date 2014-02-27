<?php
namespace DoctrineMigrationsHelper\Tests\Unit;
use Doctrine\DBAL\DriverManager;
use DoctrineMigrationsHelper\CommandSet;


class CommandSetTest extends \PHPUnit_Framework_TestCase
{


    public $connection;

    public function setUp()
    {
        $this->connection = DriverManager::getConnection(['driver' => 'pdo_sqlite','memory' => true]);
    }

    /**
     * Test of the basic class initialisation.
     **/
    public function testCreation()
    {
        $set = new CommandSet($this->connection);
        $this->assertInstanceOf("Doctrine\DBAL\Migrations\Configuration\Configuration",$set->configuration);
    }

    public function testCommands() {
        $set = new CommandSet($this->connection);
        $commands = $set->getCommands();
        $this->assertEquals(count($commands),count($set->commands));
        foreach($commands as $command) {
            $this->assertInstanceOf("Symfony\Component\Console\Command\Command",$command);
        }
    }

}