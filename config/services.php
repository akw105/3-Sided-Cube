<?php

use Zend\ServiceManager\ServiceManager;
use App\Command\ConvertCommand;

return [
    'factories' => [
        ConvertCommand::class => function (ServiceManager $serviceManager) {
            return new ConvertCommand();
        },
    ],
];
