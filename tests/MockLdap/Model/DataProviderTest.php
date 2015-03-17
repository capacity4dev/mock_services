<?php

namespace MockLdap;


use MockLdap\Model\DataProvider;


/**
 * Tests for \MockLdap\Model\EmailValidator class.
 */
class ModelDataProvider_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the provider without dummy data.
     */
    public function testWithoutDummyData()
    {
        $config = array();

        $firstName = 'foo';
        $lastName = 'bar';
        $userId = $firstName . '.' . $lastName;
        $domain = 'domain.com';
        $email = $userId . '@' . $domain;

        $provider = new DataProvider($config);
        $data = $provider->load($email);

        $this->assertEquals('valid', $data['valid']);
        $this->assertEquals($userId, $data['userId']);
        $this->assertEquals($firstName, $data['firstName']);
        $this->assertEquals($lastName, $data['lastName']);
        $this->assertEquals($email, $data['email']);

        $this->assertNull($data['title']);
        $this->assertNull($data['department']);
        $this->assertNull($data['country']);
    }

    /**
     * Test with user id of only 1 part.
     */
    public function testWithSimpleUserId()
    {
        $config = array();
        $userId = 'simple';

        $provider = new DataProvider($config);
        $data = $provider->load($userId . '@domain.com');

        $this->assertEquals($userId, $data['firstName']);
        $this->assertEquals('', $data['lastName']);
    }

    /**
     * Test with user id of multiple parts.
     */
    public function testWithExtendedUserId()
    {
        $config = array();
        $userId = 'foo.bar.biz.baz';

        $provider = new DataProvider($config);
        $data = $provider->load($userId . '@domain.com');

        $this->assertEquals('foo', $data['firstName']);
        $this->assertEquals('bar biz baz', $data['lastName']);
    }

    /**
     * Test with real dummy data.
     */
    public function testWithDummyData()
    {
        $title = 'Mr';
        $department = 'dep.01.E';
        $country = array(
            'iso' => 'BE',
            'name' => 'Belgium',
            'region' => 'Europe',
        );

        $config = array(
            'title' => array($title),
            'department' => array($department),
            'country' => array($country),
        );

        $provider = new DataProvider($config);
        $data = $provider->load('foo.bar@domain.com');

        $this->assertEquals($title, $data['title']);
        $this->assertEquals($department, $data['department']);
        $this->assertEquals($country, $data['country']);
    }
}