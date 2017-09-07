<?php

namespace App\Service;

use App\Entity\Cart;
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
     * @var Twig
     */
    protected $twig;

    public function __construct(Twig $twig, array $config)
    {
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
        $this->phpMailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->phpMailer->Port = 587;
        $this->twig = $twig;
    }

    public function sendCheckoutMail(Cart $cart)
    {
        try {

            $body = $this->twig->fetch('checkout-mail.twig', ['cart' => $cart]);

            $this->phpMailer->addAddress($cart->getCustomer()->getEmail());
            $this->phpMailer->SMTPDebug = 1;
            $this->phpMailer->Body = $body;

            $this->phpMailer->send();

            return true;

        } catch(\Throwable $e) {
            return false;
        }
    }
}
