<?php

namespace TobiasPottgueter\StopWords;

class StopWords {

	/** @var StopWordListInterface $stopWordList */
	private $stopWordList;

	/**
	 * @param StopWordListInterface $stopWordList
	 */
	public function __construct(StopWordListInterface $stopWordList) {
		$this->setStopWordList($stopWordList);
	}

	/**
	 * @param StopWordListInterface $stopWordList
	 */
	public function setStopWordList(StopWordListInterface $stopWordList) {
		$this->stopWordList = $stopWordList;
	}

	/**
	 * @param string $word
	 *
	 * @return bool
	 */
	public function isWordAStopWord(string $word): bool {
		return false !== array_search($word, $this->stopWordList->getStopWords());
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 */
	public function removeStopWordsFromString(string $string): string {
		return str_replace($this->stopWordList->getStopWords(), '', $string);
	}
}