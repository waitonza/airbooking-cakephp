<?php
App::uses('AppModel', 'Model');
/**
 * AirplaneHasSeat Model
 *
 * @property Airplane $Airplane
 * @property Seat $Seat
 */
class AirplaneHasSeat extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'airplane_has_seat';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'airplane_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'seat_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Airplane' => array(
			'className' => 'Airplane',
			'foreignKey' => 'airplane_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Seat' => array(
			'className' => 'Seat',
			'foreignKey' => 'seat_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
