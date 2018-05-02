<?php

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class MemberPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : MemberPageHandler
    {
        $template = $container->get(TemplateRendererInterface::class);

        return new MemberPageHandler($template);
    }
}
