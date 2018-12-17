<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AllocatedForm Entity
 *
 * @property int $id
 * @property string $draddpatient_id
 * @property int $form_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Draddpatient $draddpatient
 * @property \App\Model\Entity\Form $form
 */class AllocatedForm extends Entity
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
}
