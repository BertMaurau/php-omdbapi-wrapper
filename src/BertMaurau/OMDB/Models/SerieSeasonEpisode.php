<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of SerieSeasonEpisode
 *
 * @author Bert Maurau
 */
class SerieSeasonEpisode extends Title
{

    // string
    private $season;
    // integer
    private $episode;
    // integer
    private $seriesId;

    /**
     * Get the season number
     * @return integer
     */
    public function getSeason()
    {
        return $this -> season;
    }

    /**
     * Get the episode number
     * @return integer
     */
    public function getEpisode()
    {
        return $this -> episode;
    }

    /**
     * Get the series id
     * @return string
     */
    public function getSeriesId()
    {
        return $this -> seriesId;
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
     * Set the episode number
     * @param integer $episode
     * @return $this
     */
    public function setEpisode($episode)
    {
        $this -> episode = (int) $episode;
        return $this;
    }

    /**
     * Set the series id
     * @param string $seriesId
     * @return $this
     */
    public function setSeriesId($seriesId)
    {
        $this -> seriesId = (string) $seriesId;
        return $this;
    }

}
