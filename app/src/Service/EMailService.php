<?php

namespace App\Service;

use App\Entity\Cart;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use Slim\Views\Twig;

/**
 * Class sends email to the customer
 *
 * @package App\Service
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class EMailService
{
    /**
     * @var PHPMailer
     */
    protected $phpMailer;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Twig
     */
    protected $twig;

    public function __construct(Twig $twig, array $config, Logger $logger)
    {
        $this->logger = $logger;

        $this->phpMailer = new PHPMailer(true);
        $this->phpMailer->isHTML(true);
        $this->phpMailer->CharSet = 'UTF-8';
        $this->phpMailer->isSMTP();
        $this->phpMailer->Subject = 'Deine Bestellung bei den Sportfreunden Bronnen';
        $this->phpMailer->FromName = 'Sportfreunde Bronnen - Shop';
        $this->phpMailer->From = $config['from'];
        $this->phpMailer->Host = $config['serverOut'];
        $this->phpMailer->Username = $config['from'];
        $this->phpMailer->Password = $config['password'];
        $this->phpMailer->SMTPAuth = true;
        $this->phpMailer->SMTPSecure = 'tls';
        $this->phpMailer->Port = 587;
        $this->twig = $twig;
    }

    public function sendCheckoutMail(Cart $cart)
    {
        try {

            $body = $this->twig->fetch('checkout-mail.twig', ['cart' => $cart]);

            $this->phpMailer->addReplyTo('shop@sf-bronnen.de');
            $this->phpMailer->addAddress($cart->getCustomer()->getEmail());
            $this->phpMailer->addBCC('MagnusBuk@gmx.de');
            $this->phpMailer->Body = $body;

            $this->phpMailer->send();

            $this->logger->info('E-Mail versendet (' . $cart->getKey() . ')');

            return true;

        } catch(\Throwable $e) {
            $this->logger->info('Fehler bei E-Mail (' . $cart->getKey() . '): ' . $e->getTraceAsString());
            return false;
        }
    }
}
