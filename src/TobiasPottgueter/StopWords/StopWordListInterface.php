<?php

namespace TobiasPottgueter\StopWords;

interface StopWordListInterface {

	/**
	 * @return string[]
	 */
	public function getStopWords(): array;
}