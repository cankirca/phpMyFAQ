<?php

/**
 * AJAX: handling of Ajax search calls.
 *
 * This Source Code Form is subject to the terms of the Mozilla Public License,
 * v. 2.0. If a copy of the MPL was not distributed with this file, You can
 * obtain one at http://mozilla.org/MPL/2.0/.
 *
 * @category  phpMyFAQ
 * @author    Thorsten Rinne <thorsten@phpmyfaq.de>
 * @copyright 2011-2019 phpMyFAQ Team
 * @license   http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link      https://www.phpmyfaq.de
 * @since     2011-08-24
 */

use phpMyFAQ\Filter;
use phpMyFAQ\Search;

if (!defined('IS_VALID_PHPMYFAQ')) {
    $protocol = 'http';
    if (isset($_SERVER['HTTPS']) && strtoupper($_SERVER['HTTPS']) === 'ON') {
        $protocol = 'https';
    }
    header('Location: '.$protocol.'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
    exit();
}

$ajaxAction = Filter::filterInput(INPUT_GET, 'ajaxaction', FILTER_SANITIZE_STRING);
$searchTerm = Filter::filterInput(INPUT_GET, 'searchterm', FILTER_SANITIZE_STRING);

$search = new Search($faqConfig);

switch ($ajaxAction) {

    case 'delete_searchterm':

        if ($search->deleteSearchTerm($searchTerm)) {
            echo true;
        } else {
            echo false;
        }

        break;
}
