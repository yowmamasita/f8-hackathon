<?php

namespace App\Factory;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Psr\Container\ContainerInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class FirebaseFactory
{
    public function __invoke(ContainerInterface $container) : Firebase
    {
        $serviceAccount = Firebase\ServiceAccount::fromJsonFile(__DIR__.'/firebase.json');

        return (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://f8-2018-hackathon.firebaseio.com')
            ->create();
    }
}
