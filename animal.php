<?php
include 'cat.php';
{
    class Animal
    {
        private $name;
        private $age;


        public function getName(string $name)
        {
            $this->name = $name;
        }

        public function getAge(string $age)
        {
            $this->age = $age;
        }

        function getColor()
        {
            return $this->color;
        }
        function __construct(string $name, integer $age)
        {
            $this->name = $name;
            $this->age = $age;
        }
    }
}

$cat = new animal("Lucy", "12", "red");
