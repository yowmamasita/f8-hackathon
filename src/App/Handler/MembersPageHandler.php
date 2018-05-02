<?php

namespace App\Handler;

use Facebook\Facebook;
use Kreait\Firebase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * @author Ben Sarmiento <me@bensarmiento.com>
 */
final class MembersPageHandler implements RequestHandlerInterface
{
    private $facebook;

    private $firebase;

    private $template;

    public function __construct(
        Facebook $facebook,
        Firebase $firebase,
        TemplateRendererInterface $template
    ) {
        $this->facebook = $facebook;
        $this->firebase = $firebase;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $communityId = '1622481671181314';

        $helper = $this->facebook->getJavaScriptHelper();
        $userId = $helper->getUserId();

        if (!$userId) {
            header('Location: /');
            exit;
        }

//        $database = $this->firebase->getDatabase();
//        $members = $database->getReference($communityId . '/members');

        $members = json_decode(file_get_contents('https://randomuser.me/api/?results=50&nat=us&gender=female'), true);

        return new HtmlResponse($this->template->render('app::members-page',
            ['members' => $members]
        ));
    }
}
