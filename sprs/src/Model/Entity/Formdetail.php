<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Formdetail Entity
 *
 * @property int $id
 * @property int $form_id
 * @property string $field_name
 * @property string $field_type
 * @property int $is_dashboard
 * @property int $is_table
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Form $form
 * @property \App\Model\Entity\Formoption[] $formoptions
 */class Formdetail extends Entity
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
