# Welcome! #

This library can be used to retrieve information from font files.

It can open a font files and parse the binary metadata to retrieve information about the fonts like the names in the font table.

# Quick example #

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

# References #

## Microsoft ##

  * [Microsoft Typography - Free font information, TrueType, OpenType, ClearType](http://www.microsoft.com/typography/default.mspx)
  * [Microsoft Typography - OpenType Specification](http://www.microsoft.com/typography/otspec/)
  * [Microsoft Typography - Features of TrueType and OpenType](http://www.microsoft.com/typography/SpecificationsOverview.mspx)
  * [The OpenType Font File](http://www.microsoft.com/typography/otspec/otff.htm)

## Apple ##

  * [TrueType Reference Manual](http://developer.apple.com/fonts/ttrefman/)

## Other ##

  * [Difference Between TTF and OTF](http://www.differencebetween.net/technology/difference-between-ttf-and-otf/)
  * [ycTIN - TTF Info (font, ttf) - PHP Classes](http://www.phpclasses.org/package/5229-PHP-Retrieve-information-from-TrueType-font-files.html)
  * [An Introduction to TrueType Fonts: A look inside the TTF format](http://scripts.sil.org/IWS-Chapter08)
  * [PHP: Ascii to Mac Roman](http://www.bluemind.org/tips-a-tricks/6-programming/8-php-ascii-to-mac-roman.html)
  * [Typus - Vicipaedia](http://la.wikipedia.org/wiki/Typus)