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
		$words = preg_split('/[^-\w\']+/u', $string, -1, PREG_SPLIT_NO_EMPTY);

		if(1 < count($words)) {
			$stopWords = $this->stopWordList->getStopWords();

			$words = array_filter($words, function ($w) use (&$stopWords) {
				return false === array_search($w, $stopWords);
			});
		}

		if(!empty($words)) {
			return implode(' ', $words);
		}

		return $string;
	}
}