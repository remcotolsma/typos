<?php 

namespace Pronamic;

if($font = self::getAs($this->getFont(), __NAMESPACE__ . '\Typos\Typos')) { ?>

<dl>
	<dt>Copyright notice</dt>
	<dd><?php echo $font->getCopyrightNotice($query); ?></dd>

	<dt>Font family name</dt>
	<dd><?php echo $font->getFontFamilyName($query); ?></dd>

	<dt>Font sub family name</dt>
	<dd><?php echo $font->getFontSubFamilyName($query); ?></dd>

	<dt>Unique font identifier</dt>
	<dd><?php echo $font->getUniqueFontIdentifier($query); ?></dd>

	<dt>Full font name</dt>
	<dd><?php echo $font->getFullFontName($query); ?></dd>

	<dt>Version</dt>
	<dd><?php echo $font->getVersion($query); ?></dd>

	<dt>Post script name</dt>
	<dd><?php echo $font->getPostScriptName($query); ?></dd>

	<dt>TrueType</dt>
	<dd><?php echo $font->isTrueType() ? 'yes' : 'no'; ?></dd>

	<dt>OpenType</dt>
	<dd><?php echo $font->isOpenType() ? 'yes' : 'no'; ?></dd>

	<dt>Path</dt>
	<dd><?php echo Typos\Manager::getPath($font); ?></dd>

	<dt>Overview</dt>
	<dd>
		<pre><?php echo $font; ?></pre>
	</dd>
</dl>

<?php } ?>
