# Introduction #

Typos is a PHP library for reading information from font files. Currently it can only read data from TrueType and OpenType font files. The library uses the new _namespace_ functionality within PHP 5.3 (and higher).

# How to use? #

```
<?php

namespace Pronamic\Typos;

include 'library/bootstrap.php';

$font = Typos::loadFromFile('fonts/Pecita/Pecita.otf');

$query = array();
$query[] = new NameRecordQuery(NameTable::PLATFORM_MICROSOFT, Microsoft\Encodings::UNICODE_BMP, Microsoft\Languages::ENGLISH_UNITED_STATES);
$query[] = new NameRecordQuery(NameTable::PLATFORM_MACINTOSH, Macintosh\Encodings::ROMAN, Macintosh\Languages::ENGLISH);

echo $font->getFullFontName($query);

```