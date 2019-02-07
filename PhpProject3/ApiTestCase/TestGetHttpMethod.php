<?php

require('../vendor/autoload.php');

class TestGetHttpMethod extends PHPUnit_Framework_TestCase
{

    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'https://reqres.in'
        ]);
    }

    public function testSingleUser()
    {
        $response = $this->client->get('/api/users/2');

        $this->assertSame(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data['data']);
        $this->assertArrayHasKey('first_name', $data['data']);
        $this->assertArrayHasKey('last_name', $data['data']);

        $this->assertSame('Janet', $data['data']['first_name']);
    }

    public function testListUsers()
    {
        $response = $this->client->get('/api/users?page=2');

        $this->assertSame(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('total_pages', $data);
        $this->assertArrayHasKey('first_name', $data['data'][0]);

        $this->assertSame('Holt', $data['data'][0]['last_name']);
    }

    public function testUserNotFound()
    {
        $response = $this->client->get('/api/users/2');
        $this->assertSame(200, $response->getStatusCode());
    }
}
