<?php

require_once 'repository.php';
require_once __DIR__.'/../models/item.php';
require_once __DIR__.'/../models/payment.php';
require_once __DIR__.'/../models/card_payment.php';
require_once __DIR__.'/../models/blik_payment.php';

class PaymentsRepository extends Repository {

    public function add_order(string $email, Payment $payment, array $basket):bool {
        $payment_id = null;
        try {
            $this->database->begin_transaction();
            if ($payment instanceof CardPayment)
                $payment_id = $this->add_card_payment($payment);
            elseif ($payment instanceof BlikPayment)
                $payment_id = $this->add_blik_payment($payment);
            else throw new mysqli_sql_exception();

            $this->add_order_items_and_order($email, $payment_id, $basket);
            $this->deplete_inventory($basket);
            $this->database->commit();
            return true;
        }
        catch (mysqli_sql_exception $exception) {
            echo 'exception: '.$exception->getMessage();
            $this->database->rollback();
        }
        catch (Exception $exception) {
            echo 'exception: '.$exception->getMessage();
            $this->database->rollback();
        }
    }

    private function add_card_payment(CardPayment $payment) {
        $this->database->query($payment->get_query_for_add(), $payment->get_card_number(), $payment->get_expire_month(), $payment->get_expire_year(), $payment->get_cvv());
        $this->database->query("INSERT INTO payments(fk_card_payments, fk_blik_payments) VALUES(?, NULL)", $this->database->last_insert_ID());
        return $this->database->last_insert_ID();
    }

    private function add_blik_payment(BlikPayment $payment) {
        $this->database->query($payment->get_query_for_add(), $payment->get_blik());
        $this->database->query("INSERT INTO payments(fk_card_payments, fk_blik_payments) VALUES(NULL, ?)", $this->database->last_insert_ID());
        return $this->database->last_insert_ID();
    }

    private function add_order_items_and_order(string $email, $payment_id, array $basket) {
        $this->database->query("INSERT INTO orders(fk_id_users, fk_id_payments) VALUES((SELECT id_users FROM users WHERE email = ?), ?)", $email, $payment_id);
        $id_order = $this->database->last_insert_ID();
        foreach($basket as $item) {
            $this->database->query("INSERT INTO order_items(fk_id_products, fk_id_orders, quantity) VALUES((SELECT id_products from products where name=?), ?, ?)", $item["name"], $id_order, $item["count"]);
        }
    }
    private function deplete_inventory(array $basket) {
        foreach($basket as $item) {
            $this->database->query("UPDATE products SET quantity=quantity - ? WHERE name = ?", $item["count"], $item["name"]);
        }
    }
}