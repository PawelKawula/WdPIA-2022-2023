<?php

class User {
    private string $email;
    private string $passwd;
    private string $fname;
    private string $lname;
    private string $phone;

    public function __construct(string $email, string $passwd, string $fname="", string $lname="", string $phone="")
    {
        $this->email = $email;
        $this->passwd = $passwd;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phone = $phone;
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function get_passwd(): string
    {
        return $this->passwd;
    }

    public function get_fname(): string
    {
        return $this->fname;
    }

    public function get_lname(): string
    {
        return $this->lname;
    }

    public function get_phone(): string
    {
        return $this->phone;
    }

    public function set_fname(string $fname): void
    {
        $this->fname = $fname;
    }

    public function set_lname(string $lname): void
    {
        $this->lname = $lname;
    }

    public function set_phone(string $phone): void
    {
        $this->phone = $phone;
    }



}