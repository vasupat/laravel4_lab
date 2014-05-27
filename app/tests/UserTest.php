<?php

class UserTest extends TestCase {

	/**
	 * Calling User Controller From User Test
	 */
	public function testUserControllerIndex()
	{	
		$response = $this->action('GET', 'UserController@getIndex');

		$view = $response->original;

		$this->assertEquals('getIndex', $view);
	}

	public function testUserControllerProfile()
	{		
		$response = $this->action('POST', 'UserController@postProfile',array('userId' => '9'));

		$view = $response->original;

		$this->assertEquals('postProfile : 9', $view);
	}

	/**
	 * Calling User Route From User Test
	 */
	public function testUserRouteIndex()
	{	
		$response = $this->call('GET', 'user');

		$this->assertEquals('getIndex', $response->getContent());

    	//$this->assertResponseOk();
	}

	public function testUserRouteProfile()
	{	
		$response = $this->call('POST', 'user/profile/9');

		$this->assertEquals('postProfile : 9', $response->getContent());
	}

	/*
	* DOM Crawler a route
	 */
	public function testUserDomContent()
	{
		$crawler = $this->client->request('GET', 'user/content');

		$this->assertTrue($this->client->getResponse()->isOk());

		$this->assertCount(2, $crawler->filter('div:contains("Vasupat")'));
	}

	// Mocking

	// Mockey for laravel
    public function testGetsAverageTemperatureFromThreeServiceReadings()
    {
        $service = Mockery::mock('service');
        $service->shouldReceive('readTemp')->times(3)->andReturn(10, 12, 14);

        $response = new TemperaController($service);

        $this->assertEquals(12, $response->getAverage());
    }

    // Mock for phpunit
    // Ref: http://phpunit.de/manual/4.1/en/test-doubles.html
    
    public function testMock()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('UserController');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('getList')
             ->will($this->returnValue('foo'));

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertEquals('foo', $stub->getList());
    }

    public function testStubForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('SomeclassController');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnValue('foo'));

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertEquals('foo', $stub->doSomething());
    }

    public function testStub2ForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMockBuilder('SomeclassController')
                     ->disableOriginalConstructor()
                     ->getMock();

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnValue('foo'));

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertEquals('foo', $stub->doSomething());
    }

    public function testReturnSelfForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('SomeclassController');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnSelf());

        // $stub->doSomething() returns $stub
        $this->assertSame($stub, $stub->doSomething());
    }

    public function testReturnValueMapStubForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('SomeclassController');

        // Create a map of arguments to return values.
        $map = array(
          array('a', 'b', 'c', 'd'),
          array('e', 'f', 'g', 'h')
        );

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnValueMap($map));

        // $stub->doSomething() returns different values depending on
        // the provided arguments.
        $this->assertEquals('d', $stub->doSomething('a', 'b', 'c'));
        $this->assertEquals('h', $stub->doSomething('e', 'f', 'g'));
    }

    public function testReturnCallbackStubForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('SomeclassController');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnCallback('str_rot13'));

        // $stub->doSomething($argument) returns str_rot13($argument)
        $this->assertEquals('fbzrguvat', $stub->doSomething('something'));
    }

    public function testOnConsecutiveCallsStubForPhpunit()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('SomeclassController');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->onConsecutiveCalls(2, 3, 5, 7));

        // $stub->doSomething() returns a different value each time
        $this->assertEquals(2, $stub->doSomething());
        $this->assertEquals(3, $stub->doSomething());
        $this->assertEquals(5, $stub->doSomething());
    }

    // public function testThrowExceptionStubForPhpunit()
    // {
    //     // Create a stub for the SomeClass class.
    //     $stub = $this->getMock('SomeclassController');

    //     // Configure the stub.
    //     $stub->expects($this->any())
    //          ->method('doSomething')
    //          ->will($this->throwException(new Exception));

    //     // $stub->doSomething() throws Exception
    //     $stub->doSomething();
    // }

}
