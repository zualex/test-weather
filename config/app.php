<?php

declare(strict_types=1);

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions('config/containers.php');

$container = $containerBuilder->build();

return new \Weather\App($container);