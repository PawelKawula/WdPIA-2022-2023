<?php

class Category implements JsonSerializable {

    private string $name;
    private string $description;

    public function __construct(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;
    }

    public function get_name(): string {
        return $this->name;
    }

    public function set_name(string $name): void {
        $this->name = $name;
    }

    public function get_description(): string {
        return $this->description;
    }

    public function set_description(string $description): void {
        $this->description = $description;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}