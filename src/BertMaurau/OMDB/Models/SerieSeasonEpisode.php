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

    public function getSeason()
    {
        return $this -> season;
    }

    public function getEpisode()
    {
        return $this -> episode;
    }

    public function getSeriesId()
    {
        return $this -> seriesId;
    }

    public function setSeason($season)
    {
        $this -> season = (int) $season;
        return $this;
    }

    public function setEpisode($episode)
    {
        $this -> episode = (int) $episode;
        return $this;
    }

    public function setSeriesId($seriesId)
    {
        $this -> seriesId = (string) $seriesId;
        return $this;
    }

}
