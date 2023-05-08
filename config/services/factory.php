<?php

declare(strict_types=1);

use CommerceWeavers\SyliusSaferpayPlugin\Payum\Factory\AssertFactory;
use CommerceWeavers\SyliusSaferpayPlugin\Payum\Factory\AssertFactoryInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator) {
    $services = $containerConfigurator->services();

    $services->set(AssertFactory::class)->alias(AssertFactoryInterface::class, AssertFactory::class);
};