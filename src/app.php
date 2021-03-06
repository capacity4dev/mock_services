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


require_once __DIR__ . '/bootstrap.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Igorw\Silex\ConfigServiceProvider;


$app = new Application();

// Check if debug is activated in the vhost config.
if (getenv('SILEX_DEBUG') === '1') {
    $app['debug'] = true;
}

// Add Twig.
$app->register(
    new TwigServiceProvider(),
    array(
        'twig.path' => array(
            __DIR__ . '/MockLdap/resources/views',
        ),
    )
);

// Add config.
$app->register(new ConfigServiceProvider(__DIR__ . "/config/config.php"));

// Add dummy data.
$app->register(new ConfigServiceProvider(__DIR__ . '/config/dummyData.php'));

// Routes.
$app->get('/ldap', 'MockLdap\Controller\ServiceController::index');

return $app;
