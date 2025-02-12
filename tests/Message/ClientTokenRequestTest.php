<?php

namespace Omnipay\Braintree\Message;

use Braintree\Configuration;
use Omnipay\Tests\TestCase;

class ClientTokenRequestTest extends TestCase
{
    /**
     * @var ClientTokenRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new ClientTokenRequest($this->getHttpClient(), $this->getHttpRequest(), Configuration::gateway());
    }

    public function testGetData()
    {
        $this->request->initialize();
        $this->assertNull($this->request->getCustomerId());
        $this->assertEmpty($this->request->getData());
    }

    public function testGetDataWithCustomer()
    {
        $setData = [
            'customerId' => '4815162342',
            'failOnDuplicatePaymentMethod' => true,
        ];
        $expectedData = [
            'customerId' => '4815162342',
            'options' => [
                'failOnDuplicatePaymentMethod' => true,
            ],
        ];
        $this->request->initialize($setData);
        $this->assertSame('4815162342', $this->request->getCustomerId());
        $this->assertSame($expectedData, $this->request->getData());
    }

}
