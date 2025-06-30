<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixturesMessages extends Fixture
{

    // php bin/console doctrine:fixtures:load purger all old valued from DB
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 3; $i++) {
            $message = new Message();
            $message->setContent('fixture message ' . $i);
            $message->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($message);
        }

        $manager->flush();
    }
}
