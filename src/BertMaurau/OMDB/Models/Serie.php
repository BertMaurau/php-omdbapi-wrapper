<?php

namespace BertMaurau\OMDB\Models;

use BertMaurau\OMDB\Core\API as API;

/**
 * Description of Serie
 *
 * @author Bert Maurau
 */
class Serie extends Title
{

    // integer
    private $totalSeasons;

    /**
     * Get requested season for current show
     * @param integer $season
     * @return response
     * @throws \Exception
     */
    public function getFullSeason($season)
    {

        try {
            $response = API::GET('i', $this -> getImdbId(), ['Season' => $season]);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($response -> Response === 'False') {
            return (object) ['response' => false, 'reason' => $response -> Error];
        }

        $data = new SerieSeason($response);

        return (object) ['response' => true, 'type' => 'season', 'data' => $data];
    }

    /**
     * Get a specific episode for given season
     * @param integer $episode
     * @param integer $season
     * @return response
     * @throws \Exception
     */
    public function getEpisodeForSeason($episode, $season)
    {
        try {
            $response = API::GET('i', $this -> getImdbId(), ['Season' => $season, 'Episode' => $episode]);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($response -> Response === 'False') {
            return (object) ['response' => false, 'reason' => $response -> Error];
        }


        $data = new SerieSeasonEpisode($response);

        return (object) ['response' => true, 'type' => 'episode', 'data' => $data];
    }

    /**
     * Get the total seasons count
     * @return integer
     */
    public function getTotalSeasons()
    {
        return $this -> totalSeasons;
    }

    /**
     * Set the total seasons count
     * @param integer $totalSeasons
     * @return $this
     */
    public function setTotalSeasons($totalSeasons)
    {
        $this -> totalSeasons = (int) $totalSeasons;
        return $this;
    }

}
