<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\Seo\RakePlus;

/**
 * Description of StopwordsPatternFile
 *
 * @author fsvxavier
 */
class StopwordsPatternFile extends AbstractStopwordProvider {

    /** @var string */
    protected $pattern = "";

    /** @var string */
    protected $filename = "";

    /**
     * StopwordsPatternFile constructor.
     *
     * @param array $filename
     */
    public function __construct($filename) {
        $this->filename = $filename;
        $this->pattern = $this->loadLangPatternFile($filename);
    }

    /**
     * Constructs a new instance of the StopwordsPatternFile class.
     *
     * @param string $filename
     *
     * @return StopwordsPatternFile
     */
    public static function create($filename) {
        return (new self($filename));
    }

    /**
     * Constructs a new instance of the StopwordsPHP class
     * but automatically determines the filename to use
     * based on the language string provided.
     *
     * The function looks in the ./lang directory for a file called
     * xxxx.pattern file where xxxx is the language string you specified.
     *
     * @param string $language (Default is en_US)
     *
     * @return StopwordsPatternFile
     */
    public static function createFromLanguage($language = 'en_US') {
        return (new self(self::languageFile($language)));
    }

    /**
     * Returns the full path to the language file containing the
     * stopwords.
     *
     * @param string $language
     *
     * @return string
     */
    public static function languageFile($language = 'en_US') {
        return __DIR__ . '/StopWords/' . $language . '.pattern';
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
     * Returns the originally supplied filename
     *
     * @return string
     */
    public function filename() {
        return $this->filename;
    }

    /**
     * Loads the specified language file and returns with the results.
     *
     * @param string $language_file
     *
     * @return array|false
     */
    protected function loadLangPatternFile($language_file) {
        if (!file_exists($language_file)) {
            throw new \RuntimeException('Could not find the RAKE stopwords file: ' . $language_file);
        } else {
            return file_get_contents($language_file);
        }
    }

}
