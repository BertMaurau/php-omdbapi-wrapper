<?php

namespace BertMaurau\OMDB\Models;

use BertMaurau\OMDB\Core\API as API;

/**
 * Description of Title
 * Allows for getting Titles by IMDB ID, Title and Search requests.
 *
 * @author Bert Maurau
 */
class Title
{

    // string
    private $title;
    // string
    private $year;
    // string
    private $rated;
    // date
    private $released;
    // integer
    private $runtime;
    // array<Genre>
    private $genre;
    // array<Director>
    private $directors;
    // array<Writer>
    private $writers;
    // array<Actor>
    private $actors;
    // string
    private $plot;
    // string
    private $language;
    // string
    private $country;
    // string
    private $awards;
    // string
    private $poster;
    // array<Rating>
    private $ratings;
    // double
    private $metascore;
    // string
    private $imdbId;
    // double
    private $imdbRating;
    // double
    private $imdbVotes;
    // string
    private $type;

    /**
     * Call all setters for given properties on construct
     * @param array $properties
     * @return $this
     */
    public function __construct($properties = array())
    {
        if (isset($properties)) {
            // loop properties and attempt to call the setter
            foreach ($properties as $key => $value) {
                $setter = 'set' . ucfirst($key);
                // check if the setter exists and is callable
                if (is_callable(array($this, $setter))) {
                    // execute the setter
                    call_user_func(array($this, $setter), $value);
                } else if (is_callable(array($this, $setter . 's'))) {
                    // execute the setter
                    call_user_func(array($this, $setter . 's'), $value);
                } else {
                    // not a property, add to the attributes list
                    $this -> addAttribute($key, $value);
                }
            }
            return $this;
        }
    }

    /**
     * Add item as attribute (if it doesn't exist as property)
     * @param string $property
     * @param any $value
     * @return $this
     */
    public function addAttribute($property, $value)
    {
        $this -> attributes[$property] = $value;
        return $this;
    }

    /**
     * Get title by its IMDB ID
     * @param string $imdbId
     * @return response
     * @throws \Exception
     */
    public function getByImdbId($imdbId)
    {
        // check if valid imdb id
        if (!substr($imdbId, 0, 2) === 'tt') {
            throw new \Exception("'$imdbId' is not a valid IMDB ID.");
        }

        try {
            $response = API::GET('i', $imdbId);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($response -> Response === 'False') {
            return (object) ['response' => false, 'reason' => $response -> Error];
        }

        // check for type
        if ($response -> Type === 'movie') {
            $data = new Movie($response);
        } else if ($response -> Type === 'series') {
            $data = new Serie($response);
        } else {
            // return a new title object from the response
            $data = new $this($response);
        }

        return (object) ['response' => true, 'type' => $response -> Type, 'data' => $data];
    }

    /**
     * Get title by its title
     * @param string $imdbId
     * @return response
     * @throws \Exception
     */
    public function getByTitle($title, $year = null, $type = null)
    {

        $arguments = array();

        // validate the year parameter
        if (isset($year)) {
            // check if valid year
            $year = (int) $year;
            if ($year < 1000 || $year > 2300) {
                throw new \Exception("Year '$year' is not a valid year.");
            } else {
                // add it to the list of arguments
                $arguments['y'] = $year;
            }
        }

        // validate the type parameter
        if (isset($type)) {
            // check if allowed type

            if (!in_array($type, ['movie', 'series', 'episode'])) {
                throw new \Exception("Type '$type' is not an allowed value. ['movie', 'series', 'episode'].");
            } else {
                // add it to the list of arguments
                $arguments['type'] = $type;
            }
        }

        try {
            $response = API::GET('t', urlencode($title), $arguments);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($response -> Response === 'False') {
            return (object) ['response' => false, 'reason' => $response -> Error];
        }

        // check for type
        if ($response -> Type === 'movie') {
            $data = new Movie($response);
        } else if ($response -> Type === 'series') {
            $data = new Serie($response);
        } else {
            // return a new title object from the response
            $data = new $this($response);
        }

        return (object) ['response' => true, 'type' => $response -> Type, 'data' => $data];
    }

    /**
     * Search for given title
     * @param string $query
     * @param integer $year
     * @param string $type
     * @param integer $page
     * @return response
     * @throws \Exception
     */
    public function search($query, $year = null, $type = null, $page = 1)
    {

        $arguments = array();

        // validate the year parameter
        if (isset($year)) {
            // check if valid year
            $year = (int) $year;
            if ($year < 1000 || $year > 2300) {
                throw new \Exception("Year '$year' is not a valid year.");
            } else {
                // add it to the list of arguments
                $arguments['y'] = $year;
            }
        }

        // validate the type parameter
        if (isset($type)) {
            // check if allowed type

            if (!in_array($type, ['movie', 'series', 'episode'])) {
                throw new \Exception("Type '$type' is not an allowed value. ['movie', 'series', 'episode'].");
            } else {
                // add it to the list of arguments
                $arguments['type'] = $type;
            }
        }

        if ($page < 0 || $page > 100) {
            throw new \Exception("Page '$page' is outside the allowed limits (1-100).");
        } else {
            // add it to the list of arguments
            $arguments['page'] = $page;
        }

        try {
            $response = API::GET('s', urlencode($query), $arguments);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($response -> Response === 'False') {
            return (object) ['response' => false, 'reason' => $response -> Error];
        }

        // check for results amount
        $totalResult = $response -> totalResults;
        $pageResults = count($response -> Search);

        $hasMoreResults = ($pageResults < $totalResult);

        $data = array();
        foreach ($response -> Search as $key => $result) {
            $data[] = new $this($result);
        }

        return (object) ['response' => true, 'type' => 'search', 'pagination' => ['current' => $pageResults, 'total' => $totalResult, 'hasMoreResults' => $hasMoreResults], 'data' => $data];
    }

    /**
     * Get the title
     * @return string
     */
    public function getTitle()
    {
        return $this -> title;
    }

    /**
     * Get the year
     * @return integer
     */
    public function getYear()
    {
        return $this -> year;
    }

    /**
     * Get rated score
     * @return string
     */
    public function getRated()
    {
        return $this -> rated;
    }

    /**
     * Get the release date
     * @return date
     */
    public function getReleased()
    {
        return $this -> released;
    }

    /**
     * Get the runtime
     * @return integer
     */
    public function getRuntime()
    {
        return $this -> runtime;
    }

    /**
     * Get the genres
     * @return array
     */
    public function getGenre()
    {
        return $this -> genre;
    }

    /**
     * Get the directors
     * @return array
     */
    public function getDirectors()
    {
        return $this -> directors;
    }

    /**
     * Get the writers
     * @return array
     */
    public function getWriters()
    {
        return $this -> writers;
    }

    /**
     * Get the actors
     * @return array
     */
    public function getActors()
    {
        return $this -> actors;
    }

    /**
     * Get the plot
     * @return string
     */
    public function getPlot()
    {
        return $this -> plot;
    }

    /**
     * Get the language
     * @return string
     */
    public function getLanguage()
    {
        return $this -> language;
    }

    /**
     * Get the country
     * @return string
     */
    public function getCountry()
    {
        return $this -> country;
    }

    /**
     * Get the awards
     * @return string
     */
    public function getAwards()
    {
        return $this -> awards;
    }

    /**
     * Get the poster
     * @return string
     */
    public function getPoster()
    {
        return $this -> poster;
    }

    /**
     * Get the ratings
     * @return array
     */
    public function getRatings()
    {
        return $this -> ratings;
    }

    /**
     * Get the metascore
     * @return double
     */
    public function getMetascore()
    {
        return $this -> metascore;
    }

    /**
     * Get the IMDB id
     * @return string
     */
    public function getImdbId()
    {
        return $this -> imdbId;
    }

    /**
     * Get the IMDB rating
     * @return double
     */
    public function getImdbRating()
    {
        return $this -> imdbRating;
    }

    /**
     * Get the IMDB votes
     * @return double
     */
    public function getImdbVotes()
    {
        return $this -> imdbVotes;
    }

    /**
     * Get the title type
     * @return string
     */
    public function getType()
    {
        return $this -> type;
    }

    /**
     * Set the title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this -> title = $title;
        return $this;
    }

    /**
     * Set the year
     * @param integer $year
     * @return $this
     */
    public function setYear($year)
    {
        $this -> year = $year;
        return $this;
    }

    /**
     * Set the rated value
     * @param string $rated
     * @return $this
     */
    public function setRated($rated)
    {
        $this -> rated = $rated;
        return $this;
    }

    /**
     * Set the release date
     * @param string $rleased
     * @return $this
     */
    public function setReleased($released)
    {
        // convert to standard format
        try {
            $released = \DateTime::createFromFormat('d M Y', $released);
            $released = $released -> format('Y-m-d');
        } catch (Exception $ex) {
            throw new \Exception("Could not convert date '$released' from 'd M Y' to Y-m-d.");
        }
        $this -> released = (string) $released;
        return $this;
    }

    /**
     * Set the runtime
     * @param string $runtime
     * @return $this
     */
    public function setRuntime($runtime)
    {
        // remove the minutes string from value
        $runtime = trim(str_replace('min', '', $runtime));

        $this -> runtime = (integer) $runtime;
        return $this;
    }

    /**
     * Set the genre
     * @param string $genre
     * @return $this
     */
    public function setGenre($genre)
    {
        // split into seperate genres
        $genres = explode(',', $genre);

        // convert each genre to an actual object
        foreach ($genres as $key => $genre) {
            $genres[$key] = new Genre(trim($genre));
        }

        $this -> genre = $genres;
        return $this;
    }

    /**
     * Set the directors
     * @param string $directors
     * @return $this
     */
    public function setDirectors($directors)
    {
        // split into seperate directors
        $directors = explode(',', $directors);

        // convert each director to an actual object
        foreach ($directors as $key => $director) {
            $directors[$key] = new Director(trim($director));
        }

        $this -> directors = $directors;
        return $this;
    }

    /**
     * Set the writers
     * @param string $writers
     * @return $this
     */
    public function setWriters($writers)
    {
        // split into seperate writers
        $writers = explode(',', $writers);

        // convert each writer to an actual object
        foreach ($writers as $key => $writer) {
            $writers[$key] = new Writer(trim($writer));
        }
        $this -> writers = $writers;
        return $this;
    }

    /**
     * Set the actors
     * @param string $actors
     * @return $this
     */
    public function setActors($actors)
    {
        // split into seperate actors
        $actors = explode(',', $actors);

        // convert each actor to an actual object
        foreach ($actors as $key => $actor) {
            $actors[$key] = new Actor(trim($actor));
        }
        $this -> actors = $actors;
        return $this;
    }

    /**
     * Set the plot
     * @param string $plot
     * @return $this
     */
    public function setPlot($plot)
    {
        $this -> plot = (string) $plot;
        return $this;
    }

    /**
     * Set the language
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this -> language = (string) $language;
        return $this;
    }

    /**
     * Set the country
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this -> country = (string) $country;
        return $this;
    }

    /**
     * Set the awards
     * @param string $awards
     * @return $this
     */
    public function setAwards($awards)
    {
        $this -> awards = (string) $awards;
        return $this;
    }

    /**
     * Set the poster
     * @param string $poster
     * @return $this
     */
    public function setPoster($poster)
    {
        $this -> poster = (string) $poster;
        return $this;
    }

    /**
     * Set the ratings
     * @param array $ratings
     * @return $this
     */
    public function setRatings($ratings)
    {
        // convert each rating to an actual object
        foreach ($ratings as $key => $rating) {
            $ratings[$key] = new Rating($rating -> Source, $rating -> Value);
        }
        $this -> ratings = (array) $ratings;
        return $this;
    }

    /**
     * Set the metascore
     * @param string $metascore
     * @return $this
     */
    public function setMetascore($metascore)
    {
        $metascore = floatval(str_replace(",", "", $metascore));
        $this -> metascore = (double) $metascore;
        return $this;
    }

    /**
     * Set the IMDB id
     * @param string $imdbId
     * @return $this
     */
    public function setImdbId($imdbId)
    {
        $this -> imdbId = (string) $imdbId;
        return $this;
    }

    /**
     * Set the IMDB rating
     * @param string $imdbRating
     * @return $this
     */
    public function setImdbRating($imdbRating)
    {
        $imdbRating = floatval(str_replace(",", "", $imdbRating));
        $this -> imdbRating = (double) $imdbRating;
        return $this;
    }

    /**
     * Set the IMDB votes
     * @param string $imdbVotes
     * @return $this
     */
    public function setImdbVotes($imdbVotes)
    {
        $imdbVotes = floatval(str_replace(",", "", $imdbVotes));
        $this -> imdbVotes = (double) $imdbVotes;
        return $this;
    }

    /**
     * Set the title type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this -> type = (string) $type;
        return $this;
    }

}
