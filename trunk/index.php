<?php

namespace Pronamic\Typos;

include 'library/bootstrap.php';

header('Content-Type: text/html; charset=UTF-8', true);

$queueDirectory = '../queue';
$fontsDirectory = '../fonts';

$numberDublicates = 0;
$numberImported = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$paths = filter_input(INPUT_POST, 'fonts', FILTER_SANITIZE_STRING, array('flags'  => FILTER_FORCE_ARRAY));

	if($paths != null) {
		
		foreach($paths as $path) {
			$oldPath = base64_decode($path);
			$oldFile = new \SplFileInfo($oldPath);
			
			$font = Typos::loadFromFile($oldFile->getPathname());
	
			$newPath = $fontsDirectory . DS . Manager::getPath($font, $oldFile->getPathname());
			$newFile = new \SplFileInfo($newPath);

			$newDir = new \SplFileInfo($newFile->getPath());

			if(!$newDir->isDir()) {
				$created = mkdir($newDir->getPathname(), 0777, true);

				if($created === false) {
					echo $oldFile, ' -  ', $newDir;
				}
			}

			if($newFile->isFile()) {
				$numberDublicates++;
			}

			if(!$newFile->isFile() && $newDir->isDir()) {
				$renamed = rename($oldFile->getRealPath(), $newFile->getPathname());

				if($renamed) {
					$numberImported++;
				}
			}
		}
	}
}

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

		$files = new \FilesystemIterator($queueDirectory);
		$files = new \LimitIterator($files, 0, 500);

		?>
		<h2>Queue</h2>

		<dl>
			<dt>Imported</dt>
			<dd><?php echo $numberImported; ?></dd>

			<dt>Duplicates</dt>
			<dd><?php echo $numberDublicates; ?></dd>
		</dl>

		<form method="post" action="">
			<p>
				<button type="submit" name="import">Import</button>
			</p>

			<table>
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">#</th>
						<th scope="col">Family name</th>
						<th scope="col">Sub family name</th>
						<th scope="col">Full name</th>
						<th scope="col">Unique font identifier</th>
						<th scope="col">Version</th>
						<th scope="col">Post script name</th>
						<th scope="col">Version</th>
						<th scope="col">Path</th>
					</tr>
				</thead>
	
				<tbody>
	
					<?php foreach($files as $file) { ?>
	
					<?php $font = Typos::loadFromFile($file); ?>
	
					<tr>
						<td>
							<input type="checkbox" name="fonts[]" value="<?php echo base64_encode($file->getPathname()); ?>" checked="checked" />						
						</td>
						<td>
							<?php echo ++$i; ?>
						</td>
						<td>
							<?php echo $font->getFontFamilyName(); ?>
						</td>
						<td>
							<?php echo $font->getFontSubFamilyName(); ?>
						</td>
						<td>
							<?php echo $font->getFullFontName(); ?>
						</td>
						<td>
							<?php echo $font->getUniqueFontIdentifier(); ?>
						</td>
						<td>
							<?php echo $font->getVersion(); ?>
						</td>
						<td>
							<?php echo $font->getPostScriptName(); ?>
						</td>
						<td>
							<?php 
			
							switch($font->getSfntVersion()) {
								case TableDirectory::SFNT_VERSION_1_0:
								case TableDirectory::SFNT_VERSION_TRUE:
									echo 'TrueType';
									break;
								case TableDirectory::SFNT_VERSION_OTTO:
									echo 'OpenType';
									break;
								default:
									echo 'Unknown';
							}
			
							?>
						</td>
						<td>
							<?php echo Manager::getPath($font, $file); ?>
						</td>
					</tr>
	
					<?php } ?>
				</tbody>
			</table>

			<p>
				<button type="submit" name="import">Import</button>
			</p>
		</form>

		<?php

		$files = array(
			'fonts/openfontlibrary.org/Eadui/Eadui.ttf' ,
			'fonts/openfontlibrary.org/Eadui/EaduiFill.ttf' ,
			'fonts/openfontlibrary.org/Megrim/Megrim.otf' ,
			'fonts/openfontlibrary.org/Pecita/Pecita.ttf' , 
			'fonts/openfontlibrary.org/Pecita/Pecita.otf' , 
			'fonts/openfontlibrary.org/Pfennig/Pfennig.otf' ,
			'fonts/openfontlibrary.org/Pfennig/PfennigBold.otf' ,
			'fonts/openfontlibrary.org/Pfennig/PfennigBoldItalic.otf' ,
			'fonts/openfontlibrary.org/Pfennig/PfennigItalic.otf' ,
			'fonts/openfontlibrary.org/Strato/Strato-linked.ttf' , 
			'fonts/openfontlibrary.org/Strato/Strato-unlinked.ttf' ,
			'fonts/problems/Herakles/Herakles.ttf' 
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

		<?php if(true): ?>

		<div>

			<pre><?php echo $font->font->headTable; ?></pre>

		</div>

		<?php endif; ?>

		<?php endforeach; ?>
	</body>
</html>