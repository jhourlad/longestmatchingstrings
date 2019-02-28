<?php

/**
 * Get the longest matching string between two strings
 *
 * Class LongestMatchingString
 */

class LongestMatchingString
{
    protected $tracker = [];
    protected $max = 0;
    protected $pointer = 0;

    /**
     * Main code logic
     * @param $str
     * @param $str2
     * @return bool|string|null
     */

    function handle($str, $str2)
    {
        foreach (str_split($str) as $index => $char) {
            $this->tracker[$index] = [];

            foreach (str_split($str2) as $index2 => $char2) {
                $this->compareAndIncrement($char, $index, $char2, $index2);
            }
        }

        return $this->max ? substr($str, $this->pointer - $this->max + 1, $this->max) : null;
    }

    /**
     * Compare current string from index to pointer. Move pointer if matched;
     * @param $char
     * @param $index
     * @param $char2
     * @param $index2
     */

    private function compareAndIncrement($char, $index, $char2, $index2)
    {
        $this->tracker[$index][$index2] = 0;

        if ($char == $char2) {
            if ($index == 0 || $index2 == 0) {
                $current = 1;
            } else {
                if (isset($this->tracker[$index - 1][$index2 - 1])) {
                    $current = $this->tracker[$index - 1][$index2 - 1] + 1;
                } else {
                    $current = 0;
                }
            }

            $this->tracker[$index][$index2] = $current;

            if ($this->tracker[$index][$index2] > $this->max) {
                $this->max = $this->tracker[$index][$index2];
            }

            if (isset($this->tracker[$index][$index2])) {
                if( $this->tracker[$index][$index2] == $this->max ){
                    $this->pointer = $index;
                }
            }
        }
    }
}
