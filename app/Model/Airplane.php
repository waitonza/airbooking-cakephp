<?php
App::uses('AppModel', 'Model');
/**
 * Airplane Model
 *
 * @property Airline $Airline
 * @property HasSeat $HasSeat
 */
class Airplane extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'airplane';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'airline_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'model' => array(
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
		'Airline' => array(
			'className' => 'Airline',
			'foreignKey' => 'airline_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'HasSeat' => array(
			'className' => 'HasSeat',
			'joinTable' => 'airplane_has_seat',
			'foreignKey' => 'airplane_id',
			'associationForeignKey' => 'has_seat_id',
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
