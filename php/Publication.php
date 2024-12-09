<?php

class Publication
{
	public function __construct(
		public string  $title,
		public ?string $subTitle,
		public ?string $publisher,
		public ?string $bookSeries,
		public ?string $link,
		public ?string $pages,
		public ?string $volume,
		public int     $year,
		public bool    $published,
		public ?string $journal,
		public array   $authors) {
	}
}

?>
