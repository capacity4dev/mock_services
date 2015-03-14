<?php

namespace MockLdap;


use MockLdap\Model\EmailValidator;


/**
 * Tests for \MockLdap\Model\EmailValidator class.
 */
class ModelEmailValidator_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider isValidProvider
     */
    public function testIsValid($email, $expected)
    {
        $validator = $this->createValidator();
        $result = $validator->isValid($email);

        if ($expected) {
            $this->assertTrue($result);
        }
        else {
            $this->assertFalse($result);
        }
    }

    /**
     * Data provider for the testIsValid() test.
     *
     * @return array.
     */
    public function isValidProvider()
    {
        return array(
            // Invalid email addresses.
            array(null, false),
            array('', false),
            array(' ', false),
            array('justme', false),
            array('@foobar.biz', false),
            array('justme@foo.biz', false),
            array('just.me@foo.biz', false),
            array('invalid@foo.biz', false),
            array('invalid@foobar.biz', false),

            // Valid email addresses.
            array('foo.invalid@foobar.biz', true),
            array('just.me@foobar.biz', true),
            array('just.me@bizbaz.com', true),
        );
    }


    /**
     * Create a validator to use in the tests.
     *
     * @return EmailValidator
     */
    protected function createValidator()
    {
        $domains = array('foobar.biz', 'bizbaz.com');
        $pattern = '/^invalid/';

        return new EmailValidator($domains, $pattern);
    }
}