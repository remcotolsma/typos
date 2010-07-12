<?php 

namespace Pronamic\Typos; 

if($fonts = $this->getFonts()) { ?>

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
		</tr>
	</thead>

	<tbody>

		<?php foreach($fonts as $font) { ?>

		<tr>
			<td>
				<input name="fonts[]" value="" type="checkbox" />
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
		</tr>

		<?php } ?>

	</tbody>
</table>

<?php } ?>
