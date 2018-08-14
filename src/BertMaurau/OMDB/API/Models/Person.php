<?php

namespace BertMaurau\OMDB\Models;

/**
 * Description of Person
 *
 * @author Bert Maurau
 */
class Person
{

    // string
    private $name;

    /**
     * Get the person's name
     * @return string
     */
    public function getName()
    {
        return $this -> name;
    }

    /**
     * Set the person's name
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this -> name = (string) $name;
        return $this;
    }

}
