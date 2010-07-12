<?php

// Control characters
define('NUL', "\0");
define('CR', "\r");
define('LF', "\n");
define('HT', "\t");
define('CRLF', CR . LF);

// Time
define('SECOND', 1);
define('MINUTE', 60 * SECOND);
define('HOUR', 60 * MINUTE);
define('DAY', 24 * HOUR);
define('WEEK', 7 * DAY);
define('MONTH', 30 * DAY);
define('YEAR', 365 * DAY);
