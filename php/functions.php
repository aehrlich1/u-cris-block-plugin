<?php

function extract_title($item): string {
    return $item->title->value;
}

function extract_subtitle($item): ?string {
    return $item->hostPublicationSubTitle->value ?? null;
}

function extract_pages($item): ?string {
    return $item->pages ?? null;
}

function extract_publisher($item): ?string {
    return $item->publisher?->name?->text[0]?->value ?? null;
}

function extract_book_series($item): ?string {
    return $item->bookSeries[0]->title?->value ?? null;
}

function extract_link($item): ?string {
    $doi = $item->electronicVersions[0]->doi ?? null;
	$link = $item->electronicVersions[0]->link ?? null;
    $additionalLink = $item->additionalLinks[0]->url ?? null;

    return $doi ?? $link ?? $additionalLink;
}

function extract_year($item): int {
	$lastStatus = end($item->publicationStatuses);
	return $lastStatus->publicationDate->year;
}

function extract_published($item): bool {
	$publicationStatus = $item->publicationStatuses[0]->publicationStatus->term->text[0]->value ?? null;
	if (strtolower($publicationStatus) === 'unpublished') {
		return false;
	}
	return true;
}

function extract_volume($item): ?string {
    return $item->volume ?? null;
}

function extract_journal($item): ?string {
    return $item->hostPublicationTitle->value ??
		   $item->journalAssociation->title->value ??
		   $item->event->name->text[0]->value
		   ?? null;
}

function extract_authors($item): array {
    $authors = [];
    foreach ($item->personAssociations as $personAssociation) {
        $name = $personAssociation->name;
        $firstName = $name->firstName;
        $lastName = $name->lastName;
        $combinedName = $firstName . ' ' . $lastName;

        $authors[] = $combinedName;
    }
    return $authors;
}

?>
