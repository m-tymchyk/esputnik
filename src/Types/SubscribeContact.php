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
 * Class SubscribeContact
 *
 * @property Contact  $contact
 * @property string   $dedupeOn
 * @property string[] $groups
 * @link http://esputnik.com.ua/api/el_ns0_subscribeContact.html
 */
class SubscribeContact extends Object
{
    const VALUES = ['email', 'sms'];

    /**
     * @var Contact
     */
    protected $contact;

    /**
     * @var string
     */
    protected $dedupeOn;

    /**
     * @var string[]
     */
    protected $groups = [];

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param string $dedupeOn
     *
     * @throws ESException
     */
    public function setDedupeOn(string $dedupeOn)
    {
        if (!in_array($dedupeOn, self::VALUES)) {
            throw new ESException('Property type must be one of ' . implode(', ', self::VALUES) . ' values.');
        }

        $this->dedupeOn = $dedupeOn;
    }

    /**
     * @param string[]|Group[] $groups
     */
    public function setGroups(array $groups)
    {
        $this->groups = array_map(function ($group) {
            if ($group instanceof Group) {
                return $group->name;
            }

            return (string)$group;
        }, $groups);
    }
}
