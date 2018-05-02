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
final class SignupPageHandler implements RequestHandlerInterface
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
        $profile = '/members/aHR0cHM6Ly9pLmltZ3VyLmNvbS8zTGZLS25qLmpwZ35NaWNoaWU=';

        $helper = $this->facebook->getJavaScriptHelper();
        $userId = $helper->getUserId();

        if (!$userId) {
            header('Location: /');
            exit;
        }

        $database = $this->firebase->getDatabase();
        $newUser = $database->getReference($communityId . '/members/' . $userId);
        $snapshot = $newUser->getSnapshot();
        if (!$snapshot->exists()) {
            $newUser->push([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phoneNumber'],
            ]);
        }

        header('Location: ' . $profile);
        exit;
    }
}
