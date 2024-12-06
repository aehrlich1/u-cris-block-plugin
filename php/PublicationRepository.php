<?php

class PublicationRepository {
	/*
	 * TODO: $publications should be an array holding all publication objects
	 * The Publication class should have 3 sub-classes: Book, Journal, Proceedings.
	 * Depending on the type of class, a different template should be rendered.
	 * TODO: implement transients to avoid repeated fetching
	 */

	private string $apiUrl;
	private array $args;
	private array $params = array(
//		'fields'  => (
//		'title.value,
//			hostPublicationTitle.value,
//			hostPublicationSubTitle.value,
//			journalAssociation.title.*,
//			publicationStatuses.publicationDate.year,
//			personAssociations.name.*,
//			electronicVersions.doi,
//			additionalLinks.url,
//			publisher.name.text.value,
//			bookSeries.title.*,
//			pages,
//			volume'
//		),
		'order'   => 'publicationYear',
		'orderBy' => 'descending',
		'size'    => 100
	);

	public function __construct() {
		$apiKey       = get_option( 'ucris_api_key' );
		$personID     = get_option( 'ucris_person_id' );
		$this->apiUrl = 'https://ucris.univie.ac.at/ws/api/524/persons/' . $personID . '/research-outputs';
		$this->args   = array( 'headers' => array( 'Accept' => 'application/json', 'api-key' => $apiKey ) );
	}

	public function setTransient(): void {
		$publications = $this->getPublications();
		set_transient( 'publications', $publications, 1 );
	}

	public function fetchPublications(): array {
		if ( get_transient( 'publications' ) ) {
			$publications = get_transient( 'publications' );
		} else {
			$publications = $this->getPublications();
			set_transient( 'publications', $publications, DAY_IN_SECONDS );
		}

		return $publications;
	}

	private function getPublications(): array {
		$request_url = add_query_arg( $this->params, $this->apiUrl );
		$response    = wp_remote_get( $request_url, $this->args );
		$body        = wp_remote_retrieve_body( $response );

		return json_decode( $body )->items ?? [];
	}
}

?>
