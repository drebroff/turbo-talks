<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{

    /**
     * @group legacy
     */
    public function testSomething(): void
    {
        $stub = $this->getMockBuilder('chatroom\Controller\ChatController')
            ->disableOriginalConstructor(); // to disable constructor when mocking an object
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Chat Room');
    }
}
