<?php
App::uses('AppModel', 'Model');
/**
 * Booking Model
 *
 * @property Passenger $Passenger
 */
class Booking extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'booking';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'passenger_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fightNo' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Passenger' => array(
			'className' => 'Passenger',
			'foreignKey' => 'passenger_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
