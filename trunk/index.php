<?php

namespace Pronamic\Typos;

include 'library/bootstrap.php';

header('Content-Type: text/html; charset=UTF-8', true);

?>
<!DOCTYPE html>

<html dir="ltr" lang="en-US">
	<head>
		<meta charset="UTF-8" />

		<title>Fonts</title>
	</head>

	<body>
		<h1>Fonts</h1>

		<?php

		$fonts = array(
			'fonts/Pecita/Pecita.ttf' , 
			'fonts/Pecita/Pecita.otf' , 
			'fonts/Strato/Strato-linked.ttf' , 
			'fonts/Strato/Strato-unlinked.ttf' 
		);

		$search = array();
		$search[] = new NameRecordQuery(NameTable::PLATFORM_MICROSOFT, Microsoft\Encodings::UNICODE_BMP, Microsoft\Languages::ENGLISH_UNITED_STATES);
		$search[] = new NameRecordQuery(NameTable::PLATFORM_MACINTOSH, Macintosh\Encodings::ROMAN, Macintosh\Languages::ENGLISH);

		?>

		<?php foreach($fonts as $font): ?>

		<h2>TTF</h2>

		<?php

		$string = file_get_contents($font);

		$font = Typos::loadFromFile($font);
		$font = Typos::loadFromString($string);

		?>
		<dl>
			<dt>Copyright notice</dt>
			<dd><?php echo $font->getCopyrightNotice($search); ?>

			<dt>Font family name</dt>
			<dd><?php echo $font->getFontFamilyName($search); ?>

			<dt>Font sub family name</dt>
			<dd><?php echo $font->getFontSubFamilyName($search); ?>

			<dt>Unique font identifier</dt>
			<dd><?php echo $font->getUniqueFontIdentifier($search); ?>

			<dt>Full font name</dt>
			<dd><?php echo $font->getFullFontName($search); ?>

			<dt>Version</dt>
			<dd><?php echo $font->getVersion($search); ?>

			<dt>Post script name</dt>
			<dd><?php echo $font->getPostScriptName($search); ?>

			<dt>TrueType</dt>
			<dd><?php echo $font->isTrueType() ? 'yes' : 'no'; ?>

			<dt>OpenType</dt>
			<dd><?php echo $font->isOpenType() ? 'yes' : 'no'; ?>

			<dt>Overview</dt>
			<dd>
				<pre><?php echo $font; ?></pre>
			</dd>
		</dl>

		<?php if(false): ?>

		<div>

			<?php $strings = $font->nameTable->getStrings(); ?>

			<pre><?php echo var_dump($strings); ?></pre>

		</div>

		<?php endif; ?>

		<?php if(false): ?>

		<div>

			<?php 

			$nameRecords = $font->nameTable->getNameRecords(); 

			foreach($nameRecords as $nameRecord) {
				echo '<pre>', $nameRecord, '</pre>';
			}

			?>

		</div>

		<?php endif; ?>

		<?php endforeach; ?>
	</body>
</html>