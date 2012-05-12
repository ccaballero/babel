<?php

class Babel_Validators_UniqueField extends Zend_Validate_Abstract
{
    protected $_model;
    protected $_field;
    protected $_type;
    protected $_element;

    const DUPLICATE = 'duplicateEntry';
    protected $_messageTemplates = array(
        self::DUPLICATE => "'%value%' is used for another person",
    );

    // type: {new = false, edit = true}
    public function __construct($model, $field, $type = false) {
        $this->_model = $model;
        $this->_field = $field;
        $this->_type = $type;
    }

    public function setElement($element) {
        $this->_element = $element;
    }

    public function isValid($value) {
        $this->_setValue($value);

        $method = 'findBy' . ucfirst($this->_field);
        $element = $this->_model->$method($value);
        if (empty($element)) {
            return true;
        } else {
            if ($this->_type) { // Edit mode
                $field = $this->_field;

                if ($element->$field == $this->_element->$field) {
                    return true;
                }
            }

            $this->_error(self::DUPLICATE);
            return false;
        }
    }
}
