<?php
//
// WARNING: Do not edit by hand, this file was generated by Crank:
// https://github.com/gocardless/crank
//

namespace GoCardlessPro\Integration;

class EventsTest extends IntegrationTestBase
{
    public function setUp()
    {
        $this->clientAndFixtureSetup('events');
    }

    public function testResourceExists()
    {
        $obj = new \GoCardlessPro\Resources\Event(null);
        $this->assertNotNull($obj);
    }

    public function testEventsList()
    {
        $fixture = $this->stubResponse('list');

        $func_array = array_values((array) $fixture->url_params);
        $resourceService = $this->client->events();
        $response = call_user_func_array(array($resourceService, 'list'), $func_array);

        $body = $fixture->body->events;

    
        $records = $response->records();
        $this->assertInstanceOf('\GoCardlessPro\Core\ListResponse', $response);
        $this->assertInstanceOf('\GoCardlessPro\Resources\Event', $records[0]);

        $this->assertEquals($fixture->body->meta->cursors->before, $response->meta()->cursors()->before());
        $this->assertEquals($fixture->body->meta->cursors->after, $response->meta()->cursors()->after());
    

    
        foreach (range(0, count($body) - 1) as $num) {
            $record = $records[$num];
            $this->matchDeepResponse($body[$num]->action, $record->action());
            $this->matchDeepResponse($body[$num]->created_at, $record->created_at());
            $this->matchDeepResponse($body[$num]->details, $record->details());
            $this->matchDeepResponse($body[$num]->id, $record->id());
            $this->matchDeepResponse($body[$num]->links, $record->links());
            $this->matchDeepResponse($body[$num]->metadata, $record->metadata());
            $this->matchDeepResponse($body[$num]->resource_type, $record->resource_type());
            
        }

        $this->assertTrue($this->hasCheckedCurl);
    }

    public function testEventsGet()
    {
        $fixture = $this->stubResponse('get');

        $func_array = array_values((array) $fixture->url_params);
        $resourceService = $this->client->events();
        $response = call_user_func_array(array($resourceService, 'get'), $func_array);

        $body = $fixture->body->events;

    
        $this->assertInstanceOf('\GoCardlessPro\Resources\Event', $response);

        $this->matchDeepResponse($body->action, $response->action());
        $this->matchDeepResponse($body->created_at, $response->created_at());
        $this->matchDeepResponse($body->details, $response->details());
        $this->matchDeepResponse($body->id, $response->id());
        $this->matchDeepResponse($body->links, $response->links());
        $this->matchDeepResponse($body->metadata, $response->metadata());
        $this->matchDeepResponse($body->resource_type, $response->resource_type());
    

        $this->assertTrue($this->hasCheckedCurl);
    }
}
