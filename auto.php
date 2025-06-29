<?php
{
    class auto
    {
        private $merk;
        private $model;
        public $kleur;
        public $kenteken;
        protected $jaar;
        private $prijs;


        public function getPrijs()
        {
            return $this->prijs;
        }
        public function setPrijs(string $prijs)
        {
            $this->prijs = $prijs;
        }

        function __construct(string $merk, string $kleur, string $model)
        {
            $this->merk = $merk;
            $this->kleur = $kleur;
            $this->model = $model;
        }
        function setKenteken(string $Kenteken)
        {
            $this->kenteken = $Kenteken;
        }

        function getKenteken()
        {
            return $this->kenteken;
        }

    }
}
$myAuto = new auto("volkswagen", "groen", "up");