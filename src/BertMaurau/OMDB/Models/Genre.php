<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of Genre
 *
 * @author Bert Maurau
 */
class Genre
{

    // string
    private $genre;

    /**
     * Set the genre on construct
     * @param string $genre
     */
    public function __construct($genre)
    {
        $this -> setGenre($genre);
    }

    /**
     * Get the genre
     * @return string
     */
    public function getGenre()
    {
        return $this -> genre;
    }

    /**
     * Set the genre
     * @param string $genre
     * @return $this
     */
    public function setGenre($genre)
    {
        $this -> genre = (string) $genre;
        return $this;
    }

}
