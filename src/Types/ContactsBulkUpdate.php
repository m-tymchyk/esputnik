<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author  Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\Object;

/**
 * Class ContactsBulkUpdate
 *
 * @property Contact[]      $contacts
 * @property mixed          $dedupeOn
 * @property int            $fieldId
 * @property ContactField[] $contactFields
 * @property int[]          $customFieldsIDs
 * @property string[]       $groupNames
 * @property boolean        $restoreDeleted
 *
 * @link http://esputnik.com.ua/api/el_ns0_contactsBulkUpdate.html
 */
class ContactsBulkUpdate extends Object
{
    /**
     * @var Contact[]
     */
    protected $contacts = [];

    /**
     * @var mixed
     */
    protected $dedupeOn = 'email';

    /**
     * @var int
     */
    protected $fieldId;

    /**
     * @var ContactField[]
     */
    protected $contactFields = [];

    /**
     * @var int[]
     */
    protected $customFieldsIDs = [];

    /**
     * @var string[]
     */
    protected $groupNames = [];

    /**
     * @var boolean
     */
    protected $restoreDeleted = false;

    /**
     * @param Contact[] $contacts
     */
    public function setContacts(array $contacts)
    {
        $this->contacts = array_map(function ($contact) {
            return $contact instanceof Contact ? $contact : new Contact($contact);
        }, $contacts);
    }

    /**
     * Set the DedupeOn value
     *
     * @param string|int $dedupeOn
     *
     * @throws ESException
     */
    public function setDedupeOn($dedupeOn)
    {
        static $values = ['email', 'sms', 'email_or_sms', 'fieldId', 'id'];

        if (!in_array($dedupeOn, $values, true)) {
            if (is_numeric($dedupeOn)) {
                $this->fieldId = (int)$dedupeOn;
                $dedupeOn = 'fieldId';
            } else {
                throw new ESException('Property dedupeOn must be one of ' . implode(', ', $values) . ' or numeric.');
            }
        }

        $this->dedupeOn = $dedupeOn;
    }

    /**
     * Set the contactFields value
     *
     * @param ContactField[] $contactFields
     *
     * @throws ESException
     */
    public function setContactFields(array $contactFields)
    {
        static $values = [
            'firstName',
            'contactKey',
            'lastName',
            'email',
            'sms',
            'address',
            'town',
            'region',
            'postcode'
        ];

        $this->contactFields = array_map(function ($contactField) use ($values) {
            if (!in_array($contactField, $values, true)) {
                throw new ESException('Property contactFields must be array of ' . implode(', ', $values) . ' values.');
            }
        }, $contactFields);
    }

    /**
     * @param int[] $customFieldsIDs
     */
    public function setCustomFieldsIDs(array $customFieldsIDs)
    {
        $this->customFieldsIDs = array_map('intval', $customFieldsIDs);
    }

    /**
     * @param string[] $groupNames
     */
    public function setGroupNames(array $groupNames)
    {
        $this->groupNames = array_map('strval', $groupNames);
    }
}
