<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        // Insert
        $user = new User();
        $user->setEmail("hi@gmail.com");
        $user->setNom("YOUSFI");
        $user->setPrenom("Yacine");
        $user->setPassword("password");
        $user->setAPropos("Instagram");
        $user->setInstagramm("Instagram");
        // Test
        $this->assertTrue($user->getEmail()=== "hi@gmail.com");
        $this->assertTrue($user->getNom()=== "YOUSFI");
        $this->assertTrue($user->getPrenom()=== "Yacine");
        $this->assertTrue($user->getPassword()=== "password");
        $this->assertTrue($user->getAPropos()=== "Instagram");
        $this->assertTrue($user->getInstagramm()=== "Instagram");
    }
}
