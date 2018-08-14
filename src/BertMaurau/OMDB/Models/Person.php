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
    // string
    private $extra;

    /**
     * Set the name on construct and split any extra information
     * @param string $name
     */
    public function __construct($name)
    {
        // check for extra info between brackets
        preg_match('#\((.*?)\)#', $name, $extra);

        // check if there are any parts between brackets
        if (count($extra) > 0) {
            // remove that part from the name
            $name = trim(str_replace($extra[0], "", $name));

            // set that info as extra
            $this -> setExtra($extra[1]);
        }

        // set the name
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

    /**
     * Get the extra info
     * @return string
     */
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
