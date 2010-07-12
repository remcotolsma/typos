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

		$files = array(
			'fonts/Pecita/Pecita.ttf' , 
			'fonts/Pecita/Pecita.otf' , 
			'fonts/Strato/Strato-linked.ttf' , 
			'fonts/Strato/Strato-unlinked.ttf' 
		);

		$query = array();
		$query[] = new NameRecordQuery(NameTable::PLATFORM_MICROSOFT, Microsoft\Encodings::UNICODE_BMP, Microsoft\Languages::ENGLISH_UNITED_STATES);
		$query[] = new NameRecordQuery(NameTable::PLATFORM_MACINTOSH, Macintosh\Encodings::ROMAN, Macintosh\Languages::ENGLISH);

		$fonts = array();

		foreach($files as $file) {
			$fonts[] = Typos::loadFromFile($file);
		}

		$fontsView = new Views\FontsView();
		$fontsView->setInclude('views/fonts-table-view.php');
		$fontsView->setFonts($fonts);
		$fontsView->render();
		
		?>

		<?php foreach($files as $file): ?>

		<h2>TTF</h2>

		<?php $font = Typos::loadFromFile($file); ?>

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
			<dd><?php echo Manager::getPath($font, $file); ?></dd>

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