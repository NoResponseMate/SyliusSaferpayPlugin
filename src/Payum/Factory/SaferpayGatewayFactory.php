<?php

declare(strict_types=1);

namespace CommerceWeavers\SyliusSaferpayPlugin\Payum\Factory;

use CommerceWeavers\SyliusSaferpayPlugin\Payum\ValueObject\SaferpayApi;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;
use Webmozart\Assert\Assert;

class SaferpayGatewayFactory extends GatewayFactory
{
    protected function populateConfig(ArrayObject $config): void
    {
        $config->defaults([
            'payum.factory_name' => 'saferpay',
            'payum.factory_title' => 'Saferpay',
        ]);

        $config['payum.api'] = function (ArrayObject $config): SaferpayApi {
            $username = $config['username'];
            $password = $config['password'];
            $customerId = $config['customerId'];
            $terminaId = $config['terminalId'];

            Assert::string($username);
            Assert::string($password);
            Assert::string($customerId);
            Assert::string($terminaId);

            return new SaferpayApi($username, $password, $customerId, $terminaId);
        };
    }
}
