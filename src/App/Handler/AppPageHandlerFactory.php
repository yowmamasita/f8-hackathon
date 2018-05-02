<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class AppPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AppPageHandler
    {
        $template = $container->get(TemplateRendererInterface::class);

        return new AppPageHandler($template);
    }
}
