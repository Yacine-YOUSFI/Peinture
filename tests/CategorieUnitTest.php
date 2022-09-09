<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Categorie;

class CategorieUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        // Insert
        $user = new Categorie();
        $user->setDescription("aaa");
        $user->setNom("YOUSFI");
        $user->setSlug("Yacine");
        // Test
        $this->assertTrue($user->getDescription()=== "aaa");
        $this->assertTrue($user->getNom()=== "YOUSFI");
        $this->assertTrue($user->getSlug()=== "Yacine");
    }
}
