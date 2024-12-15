<?php

class PublicationService {
	private PublicationRepository $publicationRepository;

	public function __construct() {
		$this->publicationRepository = new PublicationRepository();
	}

	public function getFilteredPublications( $startingYear ): array {
		$publications         = $this->getPublications();
		$filteredPublications = $this->filter_publications( $publications, $startingYear );

		return $this->group_publications_by_year( $filteredPublications );
	}

	public function getPublications(): array {
		$rawData = $this->publicationRepository->fetchPublications();

		return $this->createPublications( $rawData );
	}

	private function createPublications( array $data ): array {
		return array_map( fn( $item ) => $this->create_publication( $item ), $data );
	}

	function create_publication( object $item ): Publication {
		return new Publication(
			extract_title( $item ),
			extract_subtitle( $item ),
			extract_publisher( $item ),
			extract_book_series( $item ),
			extract_link( $item ),
			extract_pages( $item ),
			extract_volume( $item ),
			extract_year( $item ),
			extract_published( $item ),
			extract_journal( $item ),
			extract_authors( $item ),
		);
	}

	private function filter_publications( array $publications, $startingYear ): array {
		$filters = [
			function ( $publication ) {
				return $publication->published;
			},
			function ( $publication ) use ( $startingYear ) {
				return $publication->year >= $startingYear;
			},
			function ( $publication ) {
				return stripos( $publication->journal ?? '', 'arxiv' ) === false &&
					   stripos( $publication->publisher ?? '', 'arxiv' ) === false;
			},
		];
		foreach ( $filters as $filter ) {
			$publications = array_filter( $publications, $filter );
		}

		return $publications;
	}

	private function group_publications_by_year( array $publications ): array {
		return array_reduce( $publications, function ( $grouped, $publication ) {
			$grouped[ $publication->year ][] = $publication;
			krsort( $grouped ); // Sort the years in descending order

			return $grouped;
		}, [] );
	}
}

?>
