<?php
class Question {
    public $category;
    public $first_alternative;
    public $first_alternative_score;
    public $second_alternative;
    public $second_alternative_score;

    function __construct($cat, $first, $first_score, $second, $second_score){
        $this->category = $cat;
        $this->first_alternative = $first;
        $this->first_alternative_score = $first_score;
        $this->second_alternative = $second;
        $this->second_alternative_score = $second_score;
    }
}
?>