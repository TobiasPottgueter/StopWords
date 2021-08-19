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
	public function isWordAStopWord($word) {
		return false !== array_search($word, $this->stopWordList->getStopWords());
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 */
	public function removeStopWordsFromString($string) {
		$words = explode(' ', $string);

		if(1 < count($words)) {
			$words = array_filter($words, array($this, 'isWordNotAStopWord'));
		}

		if(!empty($words)) {
			return implode(' ', $words);
		}

		return $string;
	}

	/**
	 * @param $word
	 *
	 * @return bool
	 */
	public function isWordNotAStopWord($word) {
		return !$this->isWordAStopWord($word);
	}
}