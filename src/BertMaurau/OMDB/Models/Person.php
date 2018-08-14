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
    private $extra;

    public function __construct($name)
    {
        // check for extra info between brackets
        preg_match('#\((.*?)\)#', $name, $extra);

        if (count($extra) > 0) {
            // remove that part from the name
            $name = trim(str_replace($extra[0], "", $name));
            $this -> setExtra($extra[1]);
        }
        $this -> setName($name);
    }

    /**
     * Get the person's name
     * @return string
     */
    public function getName()
    {
        return $this -> name;
    }

    public function getExtra()
    {
        return $this -> extra;
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

    /**
     * Set the extra info
     * @param string $extra
     * @return $this
     */
    public function setExtra($extra)
    {
        $this -> extra = (string) $extra;
        return $this;
    }

}
