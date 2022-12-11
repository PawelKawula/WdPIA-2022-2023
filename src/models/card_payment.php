<?php

class CardPayment extends Payment {

    private string $card_number;
    private int $expire_month;
    private int $expire_year;
    private int $cvv;

    public function __construct(string $card_number, int $expire_month, int $expire_year, int $cvv) {
        $this->card_number = $card_number;
        $this->expire_month = $expire_month;
        $this->expire_year = $expire_year;
        $this->cvv = $cvv;
    }

    public function get_card_number(): string {
        return $this->card_number;
    }

    public function get_expire_month(): int {
        return $this->expire_month;
    }

    public function get_expire_year(): int {
        return $this->expire_year;
    }

    public function get_cvv(): int {
        return $this->cvv;
    }

    public function get_query_for_add(): string {
        return "INSERT INTO payments_cards(card_number, expiration_date_month, expiration_date_year, cvv) VALUES(?, ?, ?, ?)";
    }
}