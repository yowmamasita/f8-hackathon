<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class MemberPageHandler implements RequestHandlerInterface
{
    private $template;

    public function __construct(
        TemplateRendererInterface $template
    ) {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $member = json_decode(file_get_contents('https://randomuser.me/api/?nat=us'), true);

        $latestTime = time() - rand(0, 94608000);

        $testimonials = [
            [
                'body' => '#TIL lorem ipsum 123',
                'posted_at' => $latestTime,
            ],
            [
                'body' => '#TIL lorem ipsum 345',
                'posted_at' => ceil($latestTime * 0.93),
            ],
            [
                'body' => '#TIL lorem ipsum 456',
                'posted_at' => ceil($latestTime * 0.88),
            ],
            [
                'body' => '#TIL lorem ipsum 578',
                'posted_at' => ceil($latestTime * 0.76),
            ],
            [
                'body' => '#TIL lorem ipsum 678',
                'posted_at' => ceil($latestTime * 0.62),
            ],
        ];

        return new HtmlResponse($this->template->render('app::member-page',
            [
                'member' => $member['results'][0],
                'testimonials' => $testimonials,
            ]
        ));
    }
}
