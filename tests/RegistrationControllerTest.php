<?php

namespace App\Tests;

use DateTime;
use App\Entity\Alternance;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        // Ensure we have a clean database
        $container = static::getContainer();

        /** @var EntityManager $em */
        $em = $container->get('doctrine')->getManager();
        $this->userRepository = $container->get(UserRepository::class);

        foreach ($this->userRepository->findAll() as $user) {
            $em->remove($user);
        }

        $em->flush();
    }
    /* ***************************** test register ******************************************* */
    public function testRegister(): void
    {
        // Register a new user
        $this->client->request('GET', '/register');
        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('Register');

        $this->client->submitForm('Enregistrer', [
            'registration_form[email]' => 'me@example.com', 
            'registration_form[firstname]' => 'John',
            'registration_form[lastname]' => 'Doe',
            'registration_form[plainPassword]' => 'password',
            'registration_form[agreeTerms]' => true,
        ]);

        // Ensure the response redirects after submitting the form, the user exists, and is not verified
        // self::assertResponseRedirects('/');  @TODO: set the appropriate path that the user is redirected to.
        self::assertCount(1, $this->userRepository->findAll());
        self::assertFalse(($user = $this->userRepository->findAll()[0])->isVerified());

        // Ensure the verification email was sent
        // Use either assertQueuedEmailCount() || assertEmailCount() depending on your mailer setup
        // self::assertQueuedEmailCount(1);
        // self::assertEmailCount(1);// On commente cette ligne afin de débloquer suite aux soucis liés à Mailtrap

        self::assertCount(1, $messages = $this->getMailerMessages());
        self::assertEmailAddressContains($messages[0], 'from', 'contact@alternastageconnect.fr');
        self::assertEmailAddressContains($messages[0], 'to', 'me@example.com');
        self::assertEmailTextBodyContains($messages[0], 'Ce lien expirera');

        // Login the new user
        $this->client->followRedirect();
        $this->client->loginUser($user);

        // Get the verification link from the email
        /** @var TemplatedEmail $templatedEmail */
        $templatedEmail = $messages[0];
        $messageBody = $templatedEmail->getHtmlBody();
            // echo $messageBody;
        // Afficher le corps de l'email pour vérifier le contenu
        self::assertIsString($messageBody);

        preg_match('#(http://localhost/verify/email.+)">#', $messageBody, $resetLink);

        // "Click" the link and see if the user is verified
        $this->client->request('GET', $resetLink[1]);
        $this->client->followRedirect();

        self::assertTrue(static::getContainer()->get(UserRepository::class)->findAll()[0]->isVerified());
    }

}
/* ********************************* test unitaire entiter alternance ******************************** */
class AlternanceTest extends TestCase
{
    public function testCanGetAndSetAttributes(): void
    {
    $strDescription = "Ceci est une description";
    $strMetier = "developpeur";
    $strTitre = "developpeur web junior";
    $strMission = "html";
    
    $alternance = new Alternance();
    $alternance->setDescription($strDescription)
                ->setMetier($strMetier)
                ->setTitre($strTitre)
                ->setMission($strMission);
   
    self::assertSame($strDescription, $alternance->getDescription());
    self::assertSame($strMetier, $alternance->getMetier());
    self::assertSame($strTitre, $alternance->getTitre());
    self::assertSame($strMission, $alternance->getMission());
    }
}