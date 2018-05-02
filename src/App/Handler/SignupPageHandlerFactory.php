<?php

namespace App\Handler;

use Facebook\Facebook;
use Kreait\Firebase;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class SignupPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : SignupPageHandler
    {
        $facebook = $container->get(Facebook::class);
        $firebase = $container->get(Firebase::class);
        $template = $container->get(TemplateRendererInterface::class);

        return new SignupPageHandler($facebook, $firebase, $template);
    }
}
