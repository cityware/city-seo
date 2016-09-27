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
class StopwordsText extends AbstractStopwordProvider {

    /** @var array */
    protected $stopwords = [];

    /** @var string */
    protected $pattern = "";

    /** @var string */
    protected $filename = "";

    /**
     * StopwordsPHP constructor.
     *
     * @param array $filename
     */
    public function __construct($filename) {
        $this->filename = $filename;
        $this->stopwords = $this->loadLangTextFile($filename);
        $this->pattern = $this->buildPatternFromArray($this->stopwords);
    }

    /**
     * Constructs a new instance of the StopwordsPHP class.
     *
     * @param string $filename
     *
     * @return StopwordsPHP
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
     * xxxx.php file where xxxx is the language string you specified.
     *
     * @param string $language (Default is en_US)
     *
     * @return StopwordsPHP
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
        return __DIR__ . '/StopWords/' . $language . '.txt';
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
     * @return array
     */
    protected function loadLangTextFile($language_file) {
        if (!file_exists($language_file)) {
            throw new \RuntimeException('Could not find the RAKE stopwords file: ' . $language_file);
        } else {
            $stopwords = [];
            $handle = fopen($language_file, 'r');
            if ($handle) {
                while(!feof($handle)){
                    $line = trim(fgets($handle));
                    if ($line[0] != '#') {
                        array_push($stopwords, $line);
                    }
                }
            }

            if (is_array($stopwords)) {
                if (count($stopwords) < 1) {
                    throw new \RuntimeException('No words found in RAKE stopwords file: ' . $language_file);
                } else {
                    return $stopwords;
                }
            } else {
                throw new \RuntimeException('Invalid results retrieved from RAKE stopwords file: ' . $language_file);
            }
        }
    }

}
