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
    // array<SerieSeasonEpisode>
    private $episodes;

    public function getTitle()
    {
        return $this -> title;
    }

    public function getSeason()
    {
        return $this -> season;
    }

    public function getTotalSeasons()
    {
        return $this -> totalSeasons;
    }

    public function getEpisodes()
    {
        return $this -> episodes;
    }

    public function setTitle($title)
    {
        $this -> title = (string) $title;
        return $this;
    }

    public function setSeason($season)
    {
        $this -> season = (int) $season;
        return $this;
    }

    public function setTotalSeasons($totalSeasons)
    {
        $this -> totalSeasons = (int) $totalSeasons;
        return $this;
    }

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
