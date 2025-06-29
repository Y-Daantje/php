<?php
{
    class cat
    {
        private $color;


        public function getColor(string $color)
        {
            $this->color = $color;
        }
        public function meow()
        {
            return $this->meow;
        }

        function __construct(string $color)
        {
            return $this->color;

        }
    }
    $color->setColor("red");

}
