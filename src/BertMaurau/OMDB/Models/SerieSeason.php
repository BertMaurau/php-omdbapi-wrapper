<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of SerieSeason
 *
 * @author Bert Maurau
 */
class SerieSeason extends Serie
{

    // string
    private $title;
    // integer
    private $season;
    // integer
    private $totalSeasons;
    // array
    private $episodes;

    /**
     * Get the title
     * @return string
     */
    public function getTitle()
    {
        return $this -> title;
    }

    /**
     * Get the sesaon
     * @return integer
     */
    public function getSeason()
    {
        return $this -> season;
    }

    /**
     * Get the total amount of seasons
     * @return integer
     */
    public function getTotalSeasons()
    {
        return $this -> totalSeasons;
    }

    /**
     * Get the list of episodes
     * @return array
     */
    public function getEpisodes()
    {
        return $this -> episodes;
    }

    /**
     * Set the title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this -> title = (string) $title;
        return $this;
    }

    /**
     * Set the season number
     * @param integer $season
     * @return $this
     */
    public function setSeason($season)
    {
        $this -> season = (int) $season;
        return $this;
    }

    /**
     * Set the total amount of seasons
     * @param integer $totalSeasons
     * @return $this
     */
    public function setTotalSeasons($totalSeasons)
    {
        $this -> totalSeasons = (int) $totalSeasons;
        return $this;
    }

    /**
     * Set the list of episodes
     * @param array $episodes
     * @return $this
     */
    public function setEpisodes($episodes)
    {
        // convert each genre to an actual object
        foreach ($episodes as $key => $episode) {
            $episodes[$key] = new SerieSeasonEpisode(trim($episode));
        }

        $this -> episodes = $episodes;
        return $this;
    }

}
