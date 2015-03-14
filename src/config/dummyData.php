<?php
/**
 * Dummy data to be used in the responses.
 */
$dummyData = array();

$dummyData['title'] = array(
    'Mr',
    'Ms',
    'Mss',
);

$dummyData['department'] = array(
    'DEVCO.DGA1.06',
    'DEVCO.F.2.DEL.LEBANON.002',
    'EEAS.DEL.TAJIKISTAN.004',
    'EEAS.DEL.MEXICO.004',
);

$dummyData['country'] = array(
    array(
        'iso' => 'BE',
        'name' => 'Belgium',
        'region' => 'Europe',
    ),
    array(
        'iso' => 'TJ',
        'name' => 'Tajikistan',
        'region' => 'Central Asia',
    ),
    array(
        'iso' => 'MX',
        'name' => 'Mexico',
        'region' => 'Latin America',
    ),
);

return array('dummyData' => $dummyData);
