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
    public function store()
    {
        $this->json('POST', '/api/v1/users', [
            "user_name" => "test",
            "first_name" => "test",
            "second_name" => "test",
            "first_last_name" => "test",
            "second_last_name" => "test",
            "email" => "nnn@test.com",
            "cellphone" => "1234567890",
            "password" => "test",
            "state_id" => 2
        ], [
            'Authorization' => $_ENV["API_KEY"]
        ]);

        $this->assertResponseStatus(201);
        $this->seeJsonStructure([
            "status",
            "error",
            "message",
            "current_url"
        ]);
    }

    /** @test */
    public function update()
    {
        $this->json('PUT', '/api/v1/users/12', [
            "user_name" => "test",
            "first_name" => "test",
            "second_name" => "test",
            "first_last_name" => "test",
            "second_last_name" => "test",
            "email" => "lll@test.com",
            "cellphone" => "1234567890",
            "password" => "test",
            "state_id" => 1
        ], [
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
    public function destroy()
    {
        $this->json("DELETE", '/api/v1/users/4', [], [
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
