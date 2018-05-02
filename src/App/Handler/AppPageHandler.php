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
final class AppPageHandler implements RequestHandlerInterface
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

        $database = $this->firebase->getDatabase();
        $newUser = $database->getReference($communityId . '/members/' . $userId);
        $snapshot = $newUser->getSnapshot();
        if ($snapshot->exists()) {
            header('Location: /events');
            exit;
        }

        try {
            if (!isset($_COOKIE['fb_access_token'])) $_COOKIE['fb_access_token'] = null;
            $accessToken = $_COOKIE['fb_access_token'];

            if (!$accessToken) {
                $accessToken = $helper->getAccessToken();
                setcookie('fb_access_token', $accessToken);
            }

            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->facebook->get('/me', $accessToken);
            $me = $response->getGraphUser();

            return new HtmlResponse($this->template->render('app::signup-page',
                ['name' => $me->getName(), 'email' => $me->getEmail()]
            ));
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
}
