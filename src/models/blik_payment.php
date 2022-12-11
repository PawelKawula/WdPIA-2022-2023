<?php

class BlikPayment extends Payment {

    private int $blik;

    public function __construct(int $blik) {
        $this->blik = $blik;
    }

    public function get_blik(): int {
        return $this->blik;
    }

    public function get_query_for_add(): string {
        return "INSERT INTO payments_bliks(blik) VALUES(?)";
    }
}