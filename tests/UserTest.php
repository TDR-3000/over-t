<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /** @test */
    public function get_all()
    {
        $this->json('GET', '/api/v1/users', [], [
            'Authorization' => $_ENV["API_KEY"]
        ]);

        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            "status",
            "error",
            "message",
            "current_url"
        ]);
    }

    /** @test */
    public function get_one()
    {
        $this->json('GET', '/api/v1/users/1', [], [
            'Authorization' => $_ENV["API_KEY"]
        ]);

        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            "status",
            "error",
            "message",
            "current_url"
        ]);
    }

    /** @test */
    public function disable()
    {
        $this->json('GET', '/api/v1/users/1', [], [
            'Authorization' => $_ENV["API_KEY"]
        ]);
        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            "status",
            "error",
            "message",
            "current_url"
        ]);
    }
}
