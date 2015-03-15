<?php
/**
 * Configuration for the application.
 */
$configuration = array();

/**
 * Allowed email domain.
 * Only email addresses with one of these domains will be "valid".
 */
$configuration['ldap.domains'] = array(
    'ext.ec.europa.eu',
    'ec.europa.eu',
    'cec.eu.int',
    'eeas.europa.eu',
    'ext.eeas.europa.eu',
    'jrc.ec.europa.eu',
    'ext.jrc.ec.europa.eu',
);

/**
 * Pattern that will be used to identify if a given email address must be
 * validated as an invalid one.
 */
$configuration['ldap.invalid'] = '/^invalid/';

return array('configuration' => $configuration);
