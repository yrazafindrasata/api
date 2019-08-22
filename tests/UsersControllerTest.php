<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testGetUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users', [], [], ['HTTP_ACCEPT' => 'application/json','HTTP_X-AUTH-TOKEN' => 'b4d99545ed55373e3adc']);
        $response = $client->getResponse();
        $content = $response->getContent();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
        $arrayContent = \json_decode($content, true);
        $this->assertCount(10, $arrayContent);
    }

    public function testPostUsers()
    {
        $client = static::createClient();
        $client->request('POST', '/api/users' , [], [],
            [
                'HTTP_ACCEPT' => 'application/json' ,
                'CONTENT_TYPE' => 'application/json' ,
                'HTTP_X-AUTH-TOKEN' => 'b4d99545ed55373e3adc'
            ],
            '{"apiKey": "teasting","email": "teasdaat@baehat.com","firstname": "paul","lastname": "jack"}'
        );
        $response = $client->getResponse();
        $content = $response->getContent();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }
}