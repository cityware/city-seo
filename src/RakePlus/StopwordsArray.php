<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\Seo\RakePlus;

/**
 * Description of StopwordArray
 *
 * @author fsvxavier
 */
class StopwordsArray extends AbstractStopwordProvider {

    /** @var array */
    protected $stopwords = [];

    /** @var string */
    protected $pattern = "";

    /**
     * StopwordArray constructor.
     *
     * @param array $stopwords
     */
    public function __construct(array $stopwords) {
        if (count($stopwords) > 0) {
            $this->stopwords = $stopwords;
            $this->pattern = $this->buildPatternFromArray($stopwords);
        } else {
            throw new \RuntimeException('The language array can not be empty.');
        }
    }

    /**
     * Constructs a new instance of the StopwordArray class.
     *
     * @param array $stopwords
     *
     * @return StopwordArray
     */
    public static function create(array $stopwords) {
        return (new self($stopwords));
    }

    /**
     * Returns a string containing a regular expression pattern.
     *
     * @return string
     */
    public function pattern() {
        return $this->pattern;
    }

    /**
     * Returns an array of stopwords.
     *
     * @return array
     */
    public function stopwords() {
        return $this->stopwords;
    }

}
