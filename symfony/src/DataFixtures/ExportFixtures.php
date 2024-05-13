<?php

namespace App\DataFixtures;

use App\Entity\Export;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $export = new Export();
            $export->setUser('user' . $i);
            $export->setPlace('place' . $i);
            $export->setName('name' . $i);
            $export->setDate(new \DateTime('202' . $i . '-01-01'));
            $manager->persist($export);
        }
        $manager->flush();
    }

}