<?php

namespace BertMaurau\OMDB\Models;

use BertMaurau\OMDB\Core\API as API;

/**
 * Description of Title
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
    // integer
    private $metascore;
    // string
    private $imdbId;
    // integer
    private $imdbRaing;
    // integer
    private $imdbVotes;
    // string
    private $type;

    // getByImdbId
    public function getByImdbId($imdbId)
    {
        // check if valid imdb id
        if (!substr($imdb, 0, 2) === 'tt') {
            throw new \Exception("'$imdbId' is not a valid IMDB ID.");
        }
    }

    // getByTitle
    // search


    public function getTitle()
    {
        return $this -> title;
    }

    public function getYear()
    {
        return $this -> year;
    }

    public function getRated()
    {
        return $this -> rated;
    }

    public function getReleased()
    {
        return $this -> released;
    }

    public function getRuntime()
    {
        return $this -> runtime;
    }

    public function getGenre()
    {
        return $this -> genre;
    }

    public function getDirectors()
    {
        return $this -> directors;
    }

    public function getWriters()
    {
        return $this -> writers;
    }

    public function getActors()
    {
        return $this -> actors;
    }

    public function getPlot()
    {
        return $this -> plot;
    }

    public function getLanguage()
    {
        return $this -> language;
    }

    public function getCountry()
    {
        return $this -> country;
    }

    public function getAwards()
    {
        return $this -> awards;
    }

    public function getPoster()
    {
        return $this -> poster;
    }

    public function getRatings()
    {
        return $this -> ratings;
    }

    public function getMetascore()
    {
        return $this -> metascore;
    }

    public function getImdbId()
    {
        return $this -> imdbId;
    }

    public function getImdbRaing()
    {
        return $this -> imdbRaing;
    }

    public function getImdbVotes()
    {
        return $this -> imdbVotes;
    }

    public function getType()
    {
        return $this -> type;
    }

    public function setTitle($title)
    {
        $this -> title = $title;
        return $this;
    }

    public function setYear($year)
    {
        $this -> year = $year;
        return $this;
    }

    public function setRated($rated)
    {
        $this -> rated = $rated;
        return $this;
    }

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

    public function setRuntime($runtime)
    {
        // remove the minutes string from value
        $runtime = trim(str_replace('min', '', $runtime));

        $this -> runtime = (integer) $runtime;
        return $this;
    }

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

    public function setPlot($plot)
    {
        $this -> plot = (string) $plot;
        return $this;
    }

    public function setLanguage($language)
    {
        $this -> language = (string) $language;
        return $this;
    }

    public function setCountry($country)
    {
        $this -> country = (string) $country;
        return $this;
    }

    public function setAwards($awards)
    {
        $this -> awards = (array) $awards;
        return $this;
    }

    public function setPoster($poster)
    {
        $this -> poster = (string) $poster;
        return $this;
    }

    public function setRatings($ratings)
    {
        // convert each rating to an actual object
        foreach ($ratings as $key => $rating) {
            $ratings[$key] = new Rating($rating -> source, $rating -> value);
        }
        $this -> ratings = (array) $ratings;
        return $this;
    }

    public function setMetascore($metascore)
    {
        $this -> metascore = (integer) $metascore;
        return $this;
    }

    public function setImdbId($imdbId)
    {
        $this -> imdbId = (string) $imdbId;
        return $this;
    }

    public function setImdbRaing($imdbRaing)
    {
        $this -> imdbRaing = (integer) $imdbRaing;
        return $this;
    }

    public function setImdbVotes($imdbVotes)
    {
        $this -> imdbVotes = (integer) $imdbVotes;
        return $this;
    }

    public function setType($type)
    {
        $this -> type = (string) $type;
        return $this;
    }

}
