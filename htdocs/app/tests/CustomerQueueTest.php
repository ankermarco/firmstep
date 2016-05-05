<?php

class CustomerQueueTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testRouting()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());

        $this->assertCount(1, $crawler->filter('h1:contains("Queue App")'));
	}

    public function testCustomerQueueMethodsExist()
    {
        $customerQueue = new CustomerQueue();

        $this->assertContains('getAllQueues', get_class_methods($customerQueue));
        $this->assertContains('insertQueue', get_class_methods($customerQueue));
    }

}
