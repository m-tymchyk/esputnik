<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author  Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\Object;

/**
 * Class FieldDescription
 *
 * @property string        $type
 * @property boolean       $required
 * @property boolean       $readonly
 * @property AllowedValues $allowedValues
 *
 * @link http://esputnik.com.ua/api/ns0_fieldDescription.html
 */
class FieldDescription extends Object
{
    /** @var array $types */
    static protected $types = [
        'textfield',
        'combobox',
        'checkboxlist',
        'textarea',
        'date',
        'number',
        'datetime',
        'decimal'
    ];

    /** @var string $type */
    protected $type;

    /** @var AllowedValues $allowedValues */
    protected $allowedValues;

    /** @var boolean $readonly */
    protected $required = false;

    /** @var boolean $readonly */
    protected $readonly = false;

    /**
     * @param AllowedValues $allowedValues
     */
    public function setAllowedValues($allowedValues): void
    {
        $this->allowedValues = $allowedValues instanceof AllowedValues ? $allowedValues : new AllowedValues($allowedValues);
    }
}
