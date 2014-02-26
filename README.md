## Doctrine Migration Commands Helper

This package allows the setting up of the Doctrine CLI Tools with less Boilerplate and no Config Files.

You may want to use this if you prefer to initialise migrations from your own configuration / DI container rather than requiring an xml / yml migrations configuration file.

It depends on DBAL and must be initialised with a valid DriverConnection

#### Usage


The set is designed to be passed straight to a Symfony Console Application, usage may be as follows:

    use DoctrineMigrationsHelper\CommandSet;

    $set = new CommandSet($db_connection, $namespace, $directory);

    $console->addCommands($set->getCommands());


The created configuration is available as a public property on the CommandSet so it can be manipulated in the same way as a normal Migrations configuration. For example:


    use DoctrineMigrationsHelper\CommandSet;

    $set = new CommandSet($db_connection);
    $set->configuration->setMigrationsNamespace("Example\Namespace");

    $console->addCommands($set->getCommands());



All standard CLI tools are setup by default, you can override this by manually setting the `$set->commands` array with your own set.

Additionally if your DI constructs a migrations configuration you can just overwrite the auto created one. For example:

    $set = new CommandSet($container->get("db-connection"));
    $set->configuration = $container->get("migrations");
    $console->addCommands($set->getCommands());