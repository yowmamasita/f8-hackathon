<?php

namespace App\Handler;

use Facebook\Facebook;
use Kreait\Firebase;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class MembersPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : MembersPageHandler
    {
        $facebook = $container->get(Facebook::class);
        $firebase = $container->get(Firebase::class);
        $template = $container->get(TemplateRendererInterface::class);

        return new MembersPageHandler($facebook, $firebase, $template);
    }
}
