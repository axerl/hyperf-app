<?php

declare(strict_types = 1);

namespace App\Kernel\Socket;


use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\SocketIOServer\Parser\Decoder;
use Hyperf\SocketIOServer\Parser\Encoder;
use Hyperf\SocketIOServer\SidProvider\SidProviderInterface;
use Hyperf\SocketIOServer\SocketIO;
use Hyperf\SocketIOServer\SocketIOConfig;
use Hyperf\WebSocketServer\Sender;
use Psr\Container\ContainerInterface;

class SocketIOFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $socketIOConfig = new SocketIOConfig();
        $socketIOConfig->setPingInterval(10000);
        $socketIOConfig->setPingTimeout(2000);

        return new SocketIO($container->get(StdoutLoggerInterface::class),
            $container->get(Sender::class),
            $container->get(Decoder::class),
            $container->get(Encoder::class),
            $container->get(SidProviderInterface::class),
            $socketIOConfig);
    }
}