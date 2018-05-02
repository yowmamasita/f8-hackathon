<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class AppPageHandler implements RequestHandlerInterface
{
    private $template;

    public function __construct(
        Template\TemplateRendererInterface $template
    ) {
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new HtmlResponse($this->template->render('app::signup-page', []));
    }
}
