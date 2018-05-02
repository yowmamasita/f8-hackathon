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
        $data = explode('~', base64_decode($request->getAttribute('hash')));


//        $member = json_decode(file_get_contents('https://randomuser.me/api/?nat=us'), true);

        $latestTime = time() - rand(0, 94608000);

        $testimonials = [
            [
                'body' => 'Build a Calculator using ReactJS! Yey!',
                'url' => 'https://codepen.io/jackoliver/pen/JKqAYp',
                'event_name' => 'Meetup#5 - ReactJS Study Group',
                'event_url' => 'https://www.facebook.com/events/173018913520534/?acontext=%7B%22action_history%22%3A[%7B%22surface%22%3A%22dashboard%22%2C%22mechanism%22%3A%22calendar_tab_event%22%2C%22extra_data%22%3A%22[]%22%7D]%2C%22ref%22%3A1%2C%22source%22%3A2%7D',
                'posted_at' => $latestTime,
            ],
            [
                'body' => 'I have created a Netflix Landing Page using ReactJS. Time to Binge watch later!',
                'url' => 'https://codepen.io/jackoliver/pen/zBQAWo',
                'event_name' => 'Meetup#4 - ReactJS Study Group',
                'event_url' => 'https://www.facebook.com/events/808902832652245/?acontext=%7B%22action_history%22%3A[%7B%22surface%22%3A%22dashboard%22%2C%22mechanism%22%3A%22calendar_tab_event%22%2C%22extra_data%22%3A%22[]%22%7D]%2C%22ref%22%3A1%2C%22source%22%3A2%7D',
                'posted_at' => ceil($latestTime * 0.93),
            ],
            [
                'body' => 'I have created a Login Form using ReactJS! Yes!',
                'url' => 'https://codepen.io/jackoliver/pen/XKQxvy',
                'event_name' => 'Meetup#3 - ReactJS Study Group',
                'event_url' => 'https://www.facebook.com/events/368636896988824/?acontext=%7B%22action_history%22%3A[%7B%22surface%22%3A%22dashboard%22%2C%22mechanism%22%3A%22calendar_tab_event%22%2C%22extra_data%22%3A%22[]%22%7D]%2C%22ref%22%3A1%2C%22source%22%3A2%7D',
                'posted_at' => ceil($latestTime * 0.88),
            ],
            [
                'body' => 'I have created a checkout using ReactJS.',
                'url' => 'https://codepen.io/jackoliver/pen/XNvRrQ',
                'event_name' => 'Meetup#2 - ReactJS Study Group',
                'event_url' => 'https://www.facebook.com/events/225939391507428/?acontext=%7B%22action_history%22%3A[%7B%22surface%22%3A%22dashboard%22%2C%22mechanism%22%3A%22calendar_tab_event%22%2C%22extra_data%22%3A%22[]%22%7D]%2C%22ref%22%3A1%2C%22source%22%3A2%7D',
                'posted_at' => ceil($latestTime * 0.76),
            ],
            [
                'body' => 'Today I have run my first Hello World React App. Proud!',
                'url' => 'https://codepen.io/enaqx/pen/aAcdk',
                'event_name' => 'Meetup#1 - ReactJS Study Group',
                'event_url' => 'https://www.facebook.com/events/408132192929168/?acontext=%7B%22action_history%22%3A[%7B%22surface%22%3A%22dashboard%22%2C%22mechanism%22%3A%22calendar_tab_event%22%2C%22extra_data%22%3A%22[]%22%7D]%2C%22ref%22%3A1%2C%22source%22%3A2%7D',
                'posted_at' => ceil($latestTime * 0.62),
            ],
        ];

        return new HtmlResponse($this->template->render('app::member-page',
            [
                'member' => ['name' => $data[1], 'pic' => $data[0]],
                'testimonials' => $testimonials,
            ]
        ));
    }
}
