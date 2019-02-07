<?php

require('../vendor/autoload.php');

class TestDeleteHttpMethod extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'https://reqres.in'
        ]);
    }
    
    public function testDelete()
    {
        
        $response = $this->client->delete('/api/users/2', [ //delete user 2
        'http_errors' => false
        ]);

        $this->assertSame(204, $response->getStatusCode());
    }
}
