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
 * Class Contact
 *
 * @property int            $id
 * @property string         $firstName
 * @property string         $lastName
 * @property Channel[]      $channels
 * @property Address        $address
 * @property ContactField[] $fields
 * @property int            $addressBookId
 * @property string         $contactKey
 * @property Group[]        $groups
 *
 * @link http://esputnik.com.ua/api/el_ns0_contact.html
 */
class Contact extends Object
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var Channel[]
     */
    protected $channels = [];

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var ContactField[]
     */
    protected $fields = [];

    /**
     * @var int
     */
    protected $addressBookId;

    /**
     * @var string
     */
    protected $contactKey;

    /**
     * @var Group[]
     */
    protected $groups = [];

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address instanceof Address ? $address : new Address($address);
    }

    /**
     * @param Channel[] $channels
     */
    public function setChannels(array $channels)
    {
        $this->channels = array_map(function ($channel) {
            return $channel instanceof Channel ? $channel : new Channel($channel);
        }, $channels);
    }

    /**
     * @param ContactField[] $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = array_map(function ($field) {
            return $field instanceof ContactField ? $field : new ContactField($field);
        }, $fields);
    }

    /**
     * @param Group[] $groups
     */
    public function setGroups(array $groups)
    {
        $this->groups = array_map(function ($group) {
            return $group instanceof Group ? $group : new Group($group);
        }, $groups);
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return Channel
     */
    public function addChannel($type, $value)
    {
        return $this->channels[] = new Channel([
            'channelType' => $type,
            'value'       => $value
        ]);
    }

    /**
     * @return string[int]
     */
    public function fieldsById()
    {
        return array_reduce($this->fields, function ($result, ContactField $field) {
            $result[$field->id] = $field->value;

            return $result;
        }, []);
    }
}
