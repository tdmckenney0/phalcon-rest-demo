<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
// use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
// use Phalcon\Mvc\Model\Validator\InclusionIn as InclusionInValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\InclusionIn as InclusionInValidator;

class Robots extends Model 
{
    public function validation() 
    {
        $validator = new Validation();

        $validator->add('name', new UniquenessValidator(array(
            "message" => "The robot name must be unique"
        )));

        $validator->add('type', new InclusionInValidator(array(
            "domain" => array(
                "droid",
                "mechanical",
                "virtual"
            )
        )));

        return $this->validate($validator);
    }
}