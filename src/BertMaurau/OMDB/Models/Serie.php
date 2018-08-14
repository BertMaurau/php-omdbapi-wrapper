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

        $data = new SerieSeason($response);

        return (object) ['response' => true, 'type' => 'season', 'data' => $data];
    }

    public function getEpisodeForSeason($episode, $season)
    {
        try {
            $response = API::GET('i', $this -> getImdbId(), ['Season' => $season, 'Episode' => $episode]);
        } catch (\Exception $ex) {
            throw $ex;
        }

        $data = new SerieSeasonEpisode($response);

        return (object) ['response' => true, 'type' => 'episode', 'data' => $data];
    }

    public function getTotalSeasons()
    {
        return $this -> totalSeasons;
    }

    public function setTotalSeasons($totalSeasons)
    {
        $this -> totalSeasons = (int) $totalSeasons;
        return $this;
    }

}
