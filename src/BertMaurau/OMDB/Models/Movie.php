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
    // double
    private $boxOffice;
    // string
    private $production;
    // string
    private $website;

    /**
     * Get the DVD release date
     * @return string
     */
    public function getDvd()
    {
        return $this -> dvd;
    }

    /**
     * Get the box office
     * @return double
     */
    public function getBoxOffice()
    {
        return $this -> boxOffice;
    }

    /**
     * Get the production name
     * @return string
     */
    public function getProduction()
    {
        return $this -> production;
    }

    /**
     * Get the website
     * @return string
     */
    public function getWebsite()
    {
        return $this -> website;
    }

    /**
     * Set the DVD release date
     * @param string $dvd
     * @return $this
     * @throws \Exception
     */
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

    /**
     * Set the box office value
     * @param string $boxOffice
     * @return $this
     */
    public function setBoxOffice($boxOffice)
    {
        // remove the dollar part
        $boxOffice = floatval(str_replace('$', '', str_replace(",", "", $boxOffice)));

        $this -> boxOffice = (double) $boxOffice;
        return $this;
    }

    /**
     * Set the production name
     * @param string $production
     * @return $this
     */
    public function setProduction($production)
    {
        $this -> production = (string) $production;
        return $this;
    }

    /**
     * Set the website
     * @param string $website
     * @return $this
     */
    public function setWebsite($website)
    {
        $this -> website = (string) $website;
        return $this;
    }

}
