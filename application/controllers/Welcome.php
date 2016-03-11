<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
		parent::__construct();
		$this->load->model('timetable');
	}

	public function index()
	{
		$this->load->helper('form');
		$this->data['title'] = 'XML Lab';
		$this->data['pagebody'] = 'welcome';
		$this->data['daysofweek'] = $this->timetable->getDaysOfWeek();
		$this->data['periods'] = $this->timetable->getPeriods();
		$this->data['courses'] = $this->timetable->getCourses();
		$this->data['daysearch'] = form_dropdown('day',$this->timetable->getDays());
		$this->data['timeslotsearch'] = form_dropdown('time',$this->timetable->getTimeSlots());
		$this->render();
	}
}
