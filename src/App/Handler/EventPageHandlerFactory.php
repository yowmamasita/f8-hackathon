<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class EventPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : EventPageHandler
    {
        $template = $container->get(TemplateRendererInterface::class);

        return new EventPageHandler($template);
    }
}
