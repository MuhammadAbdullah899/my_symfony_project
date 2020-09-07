<?php
// src/Updates/SiteUpdateManager.php
namespace App\Updates;

use App\Service\MessageGenerator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SiteUpdateManager
{
    private $messageGenerator;
    private $mailer;

    public function __construct(MessageGenerator $messageGenerator, MailerInterface $mailer)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
    }

    public function notifyOfSiteUpdate()
    {
        $happyMessage = $this->messageGenerator->getHappyMessage();

        $email = (new Email())
            ->from('meharabdullah899@gmail.com')
            ->to('meharabdullah899@gmail.com')
            ->subject('Site update just happened!')
            ->text('Someone just updated the site. We told them: '.$happyMessage);
        try{
            $this->mailer->send($email);            
        } catch(TransportExceptionInterface $e){
            $e->getDebug();
        }

        return true;

    }
}
?>