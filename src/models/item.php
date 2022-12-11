<?php

class Item implements JsonSerializable {
    private string $name;
    private int $quantity;
    private float $price;
    private string $description;

    public function __construct(string $name, int $quantity, float $price, string $description="") {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
    }

    public function get_name(): string {
        return $this->name;
    }

    public function get_quantity(): int {
        return $this->quantity;
    }

    public function get_price(): float {
        return $this->price;
    }

    public function get_description(): string {
        return $this->description;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}