<?php

class Coin
{
    private $id;
    private $name;
    private $years;
    private $country;
    private $shape;
    private $size;
    private $weight;
    private $front_picture;
    private $back_picture;
    private $material;
    private $rarity_index;

    function __construct($id, $name, $years, $country, $shape, $size, $weight, $front_picture, $back_picture, $material, $rarity_index)
    {
        $this->id = $id;
        $this->name = $name;
        $this->years = $years;
        $this->country = $country;
        $this->shape = $shape;
        $this->size = $size;
        $this->weight = $weight;
        $this->front_picture = $front_picture;
        $this->back_picture = $back_picture;
        $this->material = $material;
        $this->rarity_index = $rarity_index;
    }

    public function getArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "years" => $this->years,
            "country" => $this->country,
            "shape" => $this->shape,
            "size" => $this->size,
            "weight" => $this->weight,
            "material" => $this->material,
            "rarity_index" => $this->rarity_index,
            "front_picture" => base64_encode($this->front_picture),
            "back_picture" => base64_encode($this->back_picture)
        ];
    }
}
