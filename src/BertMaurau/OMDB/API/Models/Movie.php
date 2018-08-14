<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of Movie
 *
 * @author Bert Maurau
 */
class Movie extends Title
{

    // date
    private $dvd;
    // integer
    private $boxOffice;
    // string
    private $production;
    // string
    private $website;

    public function getDvd()
    {
        return $this -> dvd;
    }

    public function getBoxOffice()
    {
        return $this -> boxOffice;
    }

    public function getProduction()
    {
        return $this -> production;
    }

    public function getWebsite()
    {
        return $this -> website;
    }

    public function setDvd($dvd)
    {
        // convert to standard format
        try {
            $dvd = \DateTime::createFromFormat('d M Y', $dvd);
            $dvd = $dvd -> format('Y-m-d');
        } catch (Exception $ex) {
            throw new \Exception("Could not convert date '$dvd' from 'd M Y' to Y-m-d.");
        }
        $this -> dvd = $dvd;
        return $this;
    }

    public function setBoxOffice($boxOffice)
    {
        // remove the dollar part
        $boxOffice = str_replace('$', '', $boxOffice);

        $this -> boxOffice = (integer) $boxOffice;
        return $this;
    }

    public function setProduction($production)
    {
        $this -> production = (string) $production;
        return $this;
    }

    public function setWebsite($website)
    {
        $this -> website = (string) $website;
        return $this;
    }

}
