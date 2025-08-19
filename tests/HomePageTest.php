<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Output\ConsoleOutput;

class HomePageTest extends WebTestCase
{

    /**
     * @group legacy
     */
    public function testSomething(): void
    {
        $output = new ConsoleOutput();
        $a = " PHPUnit Bridge parallelize test suites execution when giving a directory";
        $output->writeln('<question>'.$a.'</question>');

        $stub = $this->getMockBuilder('chatroom\Controller\ChatController')
            ->disableOriginalConstructor(); // to disable constructor when mocking an object
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        // Methods can be used:
        // tick() for checkboxes
        // select() for selects
        // upload() for files

        $form = $crawler->selectButton('Send')->form(); // Select the button and get the form


        $crawler = $client->submitForm('Send', [
            'form[content]' => 'Mai tst',
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Chat Room');
    }
}
