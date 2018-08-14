<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of Rating
 *
 * @author Bert Maurau
 */
class Rating
{

    // string
    private $source;
    // string
    private $rating;

    public function __construct($source, $rating)
    {
        $this -> setSource($source);
        $this -> setRating($rating);
    }

    /**
     * Get the source
     * @return string
     */
    public function getSource()
    {
        return $this -> source;
    }

    /**
     * Get the rating
     * @return string
     */
    public function getRating()
    {
        return $this -> rating;
    }

    /**
     * Set the source
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this -> source = $source;
        return $this;
    }

    /**
     * Set the rating
     * @param string $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this -> rating = $rating;
        return $this;
    }

}
