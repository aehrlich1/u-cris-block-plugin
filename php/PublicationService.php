<?php

class PublicationService
{
	private PublicationRepository $publicationRepository;

	public function __construct() {
		$this->publicationRepository = new PublicationRepository();
	}

	public function getPublications(): array {
		$rawData = $this->publicationRepository->fetchPublications();
		return $this->createPublications($rawData);
	}

	private function createPublications(array $data): array {
		return array_map(fn($item) => $this->create_publication($item), $data);
	}

	private function publications_grouped_by_year_and_filtered(array $publications): array {
		return array_reduce($publications, function ($grouped, $publication) {
			if ($publication->journal !== null) {
				$grouped[$publication->year][] = $publication;
			}

			krsort($grouped);
			return $grouped;
		}, []);
	}

	private function filter_publications_by_year($publicationsGroupedByYear, $startingYear): array {
		if (isset($startingYear)) {
			return array_filter($publicationsGroupedByYear, function ($key) use ($startingYear) {
				return $key >= $startingYear;
			}, ARRAY_FILTER_USE_KEY);
		}
		return $publicationsGroupedByYear;
	}

	public function getFilteredPublications($startingYear): array {
		$publications = $this->getPublications();
		$groupedPublications = $this->publications_grouped_by_year_and_filtered($publications);
		return $this->filter_publications_by_year($groupedPublications, $startingYear);
	}

	function create_publication(object $item): Publication {
		return new Publication(
			extract_title($item),
			extract_subtitle($item),
			extract_publisher($item),
			extract_book_series($item),
			extract_link($item),
			extract_pages($item),
			extract_volume($item),
			extract_year($item),
			extract_journal($item),
			extract_authors($item),
		);
	}
}

?>
