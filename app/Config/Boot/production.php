<?php

/*
 |--------------------------------------------------------------------
 | ERROR DISPLAY
 |--------------------------------------------------------------------
 | In production, NEVER show errors. Let CI handle generic error page.
 */
ini_set('display_errors', '0');

/*
 |--------------------------------------------------------------------
 | ERROR REPORTING
 |--------------------------------------------------------------------
 | Suppress warnings, notices, undefined array key, deprecated, strict.
 | Allow only fatal errors so system stability is maintained.
 */
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR);

/*
 |--------------------------------------------------------------------
 | DEBUG MODE
 |--------------------------------------------------------------------
 */
defined('CI_DEBUG') || define('CI_DEBUG', false);