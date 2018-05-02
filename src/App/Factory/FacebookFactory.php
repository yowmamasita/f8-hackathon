<?php

namespace App\Factory;

use Facebook\Facebook;
use Psr\Container\ContainerInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class FacebookFactory
{
    public function __invoke(ContainerInterface $container) : Facebook
    {
        return new Facebook([
            'app_id' => '198081521001550',
            'app_secret' => '5a039979db1ebcf3802b2b2d19e51518',
            'default_graph_version' => 'v3.0',
        ]);
    }
}
