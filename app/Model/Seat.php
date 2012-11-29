<?php
App::uses('AppModel', 'Model');
/**
 * Seat Model
 *
 * @property AirplaneHa $AirplaneHa
 */
class Seat extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'seat';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'availabillity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'seatClass' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'AirplaneHa' => array(
			'className' => 'AirplaneHa',
			'joinTable' => 'airplane_has_seat',
			'foreignKey' => 'seat_id',
			'associationForeignKey' => 'airplane_ha_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
