<?php
$startingYear         = $attributes['startingYear'] ?? null;
$publicationService   = new PublicationService();
$filteredPublications = $publicationService->getFilteredPublications( $startingYear );
?>

<div <?php echo get_block_wrapper_attributes() ?>>
	<?php foreach ( $filteredPublications as $year => $publications ) : ?>
		<h3><?php echo $year ?></h3>
		<hr class="wp-block-separator is-style-wide">

		<?php foreach ( $publications as $publication ) : ?>
			<div class="publication-section">
				<?php if ( $publication->link ): ?>
				<a href="<?php echo $publication->link; ?>" target="_blank">
					<?php endif; ?>
					<h4><?php echo $publication->title; ?></h4>
					<?php if ( $publication->link ): ?>
				</a>
			<?php endif; ?>
				<?php $authors = implode( ", ", $publication->authors ) ?>
				<p class="italic"> <?php echo $authors ?></p>
				<p> <?php
					echo $publication->journal;
					echo $publication->publisher ? ", {$publication->publisher}" : "";
					echo $publication->volume ? ", Vol. {$publication->volume}" : "";
					echo $publication->pages ? ", P. {$publication->pages}" : "";
					echo $publication->subTitle ? ", ({$publication->subTitle})" : "";
					echo $publication->bookSeries ? ", ({$publication->bookSeries})" : "";
					?>
				</p>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
