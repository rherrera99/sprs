<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $dob
 * @property string $address
 * @property string $about
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $contact_no
 * @property int $gender
 * @property string $app_token
 * @property string $profile_pic
 * @property float $height
 * @property float $weight
 * @property \Cake\I18n\Time $last_login
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $doctor_id
 * @property int $status
 * @property int $is_delete
 *
 * @property \App\Model\Entity\Doctor $doctor
 * @property \App\Model\Entity\Draddpatient[] $draddpatients
 */
class Patient extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
