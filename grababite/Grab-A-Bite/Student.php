<?php
/**
 * Created by PhpStorm.
 * User: ronalddavis
 * Date: 11/30/17
 * Time: 4:12 PM
 */
declare(strict_types=1);

class Student{

    private $email;

    public function __construct(string $email) {
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }
}