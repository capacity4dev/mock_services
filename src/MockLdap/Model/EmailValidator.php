<?php
/**
 * This file is part of mock_ldap.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/capacity4dev/mock_ldap source repository.
 * @copyright Copyright (c) 2015 amplexor.com, europa.ec.eu
 * @license   http://opensource.org/licenses/MIT
 */


namespace MockLdap\Model;


/**
 * Validator for the given email address.
 */
class EmailValidator
{
    /**
     * Email domain that should be supported as valid.
     *
     * @var array
     */
    protected $domains;

    /**
     * Pattern to use to detect a forced invalid email address.
     *
     * @var string
     */
    protected $invalidPattern;


    /**
     * Constructor.
     *
     * @param array $domains
     *     An array with email domains that should be seen as valid.
     * @param string $invalidPattern
     *     A regular expression pattern to identify email addresses that are
     *     forcing to be invalid.
     */
    public function __construct(array $domains, $invalidPattern)
    {
        $this->domains = $domains;
        $this->invalidPattern = $invalidPattern;
    }

    /**
     * Validate the given email address.
     *
     * @param string $email
     *     The email address to validate.
     *
     * @return bool
     *     Is valid
     */
    public function isValid($email)
    {
        $isValid = true;

        if (!$this->isValidFormat($email)) {
            $isValid = false;
        }
        if ($this->isForcedInvalid($email)) {
            $isValid = false;
        }
        if (!$this->isValidDomain($email)) {
            $isValid = false;
        }

        return $isValid;
    }

    /**
     * Helper to check if the given email has a valid format.
     *
     * @param string $email
     *     The email address to check.
     *
     * @return bool
     *     The email address has a valid format.
     */
    protected function isValidFormat($email)
    {
        $pattern = '/^[\w\-_]+\.[\w\-_]+(\.[\w\-_]+)*@([\w\-_]+\.)+[\w\-_]{2,}$/';
        return (bool) preg_match($pattern, $email);
    }

    /**
     * Helper to detect if the email domain is forcing to be invalid.
     *
     * @param string $email
     *     The email address to check.
     *
     * @return bool
     *     Is forced invalid.
     */
    protected function isForcedInvalid($email)
    {
        if (empty($this->invalidPattern)) {
            return false;
        }
        return (bool) preg_match($this->invalidPattern, $email);
    }

    /**
     * Validate if it is a valid email domain.
     *
     * @param string $email
     *     The email address to check.
     *
     * @return bool
     *     Is valid domain.
     */
    protected function isValidDomain($email)
    {
        $split = explode('@', $email);
        if (count($split) !== 2) {
            return false;
        }

        return in_array($split[1], $this->domains);
    }
}
