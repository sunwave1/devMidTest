<?php

class Student {

    public function __construct(public string $name, public string $className, public array $terms = []){}

    public function getStudentName() : string {

        return $this->name;
    }

    public function setStudentName(string $name) : Student {

        $this->name = $name;

        return $this;
    }

    public function getClassName() : string {

        return $this->className;
    }

    public function setClassName(string $name) : Student {

        $this->className = $name;

        return $this;
    }

    public function getAverage(mixed $key) : float {

        return $this->getGrade($key) / 4;
    }

    public function getGrade(mixed $key) : float {
        return isset( $this->terms[ $key ] ) ? array_reduce($this->terms[ $key ]['grade'], function($carry, $it) { 

            $carry += (int)$it;

            return $carry; 
        }, 0) : 0;
    }

    public function getGradeByIndex(mixed $term, int $index) : int {
        return (isset($this->terms[$term]) && isset($this->terms[$term]['grade'])) ? 
            (int)$this->terms[$term]['grade'][$index] 
        : 0;
    }

    public function addGrade(mixed $term, mixed $grade) : Student {

        $this->terms[ $term ]['grade'] = $grade;

        return $this;
    }

    public function getTerms() : array {

        return $this->terms;   
    }

    public function getTerm(int $id) : array|null {
        return !empty($this->terms[ $id ]) ? $this->terms[ $id ] : NULL;
    }

    public function hasTerm(int $id) : bool {
        return $this->getTerm($id) !== NULL;
    }

    public function addTerm(mixed $key, mixed $term) : Student {

        $this->terms[ $key ] = $term;

        return $this;
    }
    
    public function setTerm(array $term) : Student {

        $this->terms = $term; 
        
        return $this;
    }
}