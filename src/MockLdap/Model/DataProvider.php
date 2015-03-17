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
 * Data provide to return user data based on the given email address.
 *
 * This will use the user part of the email address (before the @) to extract
 * the user ID, First name and Last name. The rest of the data will be randomly
 * selected from the dummy data config file.
 */
class DataProvider
{
    /**
     * Available Salutations.
     *
     * @var array
     */
    protected $titles = array();

    /**
     * Available Departments.
     *
     * @var array
     */
    protected $departments = array();

    /**
     * Available Countries.
     *
     * @var array
     */
    protected $countries = array();


    /**
     * Constructor.
     *
     * @param array $dummyData
     *     Pass the config array containing the titles, departments & countries.
     */
    public function __construct($dummyData = array())
    {
        if (!empty($dummyData['title'])) {
            $this->titles = $dummyData['title'];
        }

        if (!empty($dummyData['department'])) {
            $this->departments = $dummyData['department'];
        }

        if (!empty($dummyData['country'])) {
            $this->countries = $dummyData['country'];
        }
    }

    /**
     * Load the data by the given email address.
     *
     * @param string $email
     *     The email address to load the data for.
     *
     * @return array $data.
     */
    public function load($email)
    {
        $data = array(
            'valid' => 'valid',
            'title' => $this->title(),
            'userId' => $this->userId($email),
            'firstName' => $this->firstName($email),
            'lastName' => $this->lastName($email),
            'email' => $email,
            'department' => $this->department(),
            'country' => $this->country(),
        );

        return $data;
    }

    /**
     * Get a random title from the dummy data.
     *
     * @return string
     */
    protected function title()
    {
        return $this->randValue($this->titles);
    }

    /**
     * Get the userId from the email address.
     *
     * The userId is based on the part of the email address before the @.
     *
     * @param string $email
     *     The email address to create the userId from.
     *
     * @return string
     *     The userId.
     */
    protected function userId($email)
    {
        $parts = explode('@', $email);
        return array_shift($parts);
    }

    /**
     * Get the first name based on the given email address.
     *
     * @param string $email
     *     The email address to extract the first name from.
     *
     * @return string
     */
    protected function firstName($email)
    {
        $parts = $this->nameParts($email);
        return $parts['first'];
    }

    /**
     * Get the last name based on the given email address.
     *
     * @param string $email
     *     The email address to extract the last name from.
     *
     * @return string
     */
    protected function lastName($email)
    {
        $parts = $this->nameParts($email);
        return $parts['last'];
    }

    /**
     * Get the name parts out of the email address.
     *
     * @param string $email
     *     The email address to extract the last name from.
     *
     * @return array
     *     An array containing the parts:
     *     - first name
     *     - last name
     */
    protected function nameParts($email)
    {
        $userId = $this->userId($email);
        $parts = explode('.', $userId, 2);

        $firstName = array_shift($parts);
        $lastName  = array_shift($parts);
        $lastName  = str_replace('.', ' ', $lastName);

        $parts = array(
            'first' => $firstName,
            'last'  => $lastName,
        );
        return $parts;
    }

    /**
     * Get a random department.
     *
     * @return string
     */
    protected function department()
    {
        return $this->randValue($this->departments);
    }

    /**
     * Get a random country.
     *
     * @return array
     */
    protected function country()
    {
        return $this->randValue($this->countries);
    }

    /**
     * Get a random value from the given array.
     *
     * @param array $values
     *     The array with values to pick from.
     *
     * @return mixed
     */
    protected function randValue($values)
    {
        $key = array_rand($values);
        if (empty($values[$key])) {
            return;
        }

        return $values[$key];
    }
}
