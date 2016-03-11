<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
		parent::__construct();
		$this->load->model('timetable');
		$this->load->helper('form');
	}

	public function index()
	{
            
                $this->data['Search'][] = $this->timetable->searchCourses("Monday", "11:30-12:20");
                $this->data['Search'][] = $this->timetable->searchPeriods("Monday", "11:30-12:20");
                $this->data['Search'][]= $this->timetable->searchDaysOfWeek("Monday", "11:30-12:20");
		$this->data['title'] = 'XML Lab';
		$this->data['pagebody'] = 'welcome';
		$this->data['daysofweek'] = $this->timetable->getDaysOfWeek();
		$this->data['periods'] = $this->timetable->getPeriods();
		$this->data['courses'] = $this->timetable->getCourses();
		$this->data['daysearch'] = form_dropdown('day',$this->timetable->getDays());
		$this->data['timeslotsearch'] = form_dropdown('time',$this->timetable->getTimeSlots());
		$this->render();
	}

	function results()
	{
		$this->data['title'] = 'XML Lab Results';
		$this->data['pagebody'] = 'results';
		$this->input->post('day');
		$this->input->post('time');

		// call search function

		$this->render();
	}
}
