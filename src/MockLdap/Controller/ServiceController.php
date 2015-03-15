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


namespace MockLdap\Controller;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MockLdap\Model\EmailValidator;


/**
 * Controller that provides the service to validate a given email address.
 */
class ServiceController
{
    /**
     * Action to validate the passed email address.
     *
     * @param Request $request
     * @param Application $app
     *
     * @return Response
     */
    public function index(Request $request, Application $app)
    {
        //var_dump($app['configuration']);
        //var_dump($app['dummyData']);

        $data = array();

        // Get the email address.
        $event = $request->get('event', null);
        if ($event !== 'c4d.checkUser') {
            return new Response('Invalid Event', 404);
        }

        $email = $request->get('email', null);

        $config = $app['configuration'];
        $validator = new EmailValidator(
            $config['ldap.domains'],
            $config['ldap.invalid']
        );
        if (!$validator->isValid($email)) {
            $data['valid'] = 'invalid';
        }
        else {
            // $dataProvider = new MockLdap\Model\Provider\Ldap($app['dummyData']);
            // $data = $dataProvider->load($email);

            // Process the request.
            $data = array(
                'valid' => 'valid',
                'title' => '',
                'userId' => '',
                'firstName' => '',
                'lastName' => '',
                'email' => $email,
                'department' => '',
                'country' => array(
                    'iso' => '',
                    'name' => '',
                    'region' => '',
                ),
            );
        }

        // Create the XML.
        $content = $app['twig']->render('response.xml.twig', $data);

        // Send the response.
        $response = new Response();
        $response->headers->set('Content-type', 'text/xml');
        $response->setContent($content);

        return $response;
    }
}
