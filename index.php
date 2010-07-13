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

		<?php 
		
		$font = Typos::loadFromFile($file); 

		$fontView = new Views\FontView();
		$fontView->setInclude('views/font-definition-list-view.php');
		$fontView->setFont($font);
		$fontView->render();

		?>

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