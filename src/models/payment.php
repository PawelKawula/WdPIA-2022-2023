<?php

abstract class Payment {
    abstract public function get_query_for_add(): string;
}