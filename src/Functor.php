<?php
namespace Inquizarus\Phunc;

class Functor implements FunctorInterface
{

    /** @var array|string **/
    private $data = null;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function reduce($f, $initial = null)
    {
        $input = is_string($this->data)
            ? $this->arrayFromString($this->data)
            : $this->data;

        return array_reduce($input, $f, $initial);
    }

    /**
     * @inheritDoc
     */
    public function filter($f): FunctorInterface
    {
        if (is_array($this->data)) {
            return new self(array_values(array_filter($this->data, $f)));
        }
        if (is_string($this->data)) {
            $pieces = $this->arrayFromString($this->data);
            $filteredPieces = array_filter($pieces, $f);
            return new self(implode("", $filteredPieces));
        }
    }

    /**
     * @inheritDoc
     */
    public function map($f): FunctorInterface
    {
        if (is_array($this->data)) {
            return new self(array_map($f, $this->data));
        }
        if (is_string($this->data)) {
            $pieces = $this->arrayFromString($this->data);
            $mappedPieces = array_map($f, $pieces);
            return new self(implode("", $mappedPieces));
        }
    }

    /**
     * @param string $input The string to convert to an array
     *
     * @return string[]
     */
    private function arrayFromString(string $input): array
    {
        $pieces = [];
        preg_match_all("/./",  $input, $pieces);
        return array_shift($pieces);
    }
}
