<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
		parent::__construct();
		$this->load->model('timetable');
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
                $this->data['daysearch'] = $this->timetable->getDays();
                $this->data['timeslotsearch'] = $this->timetable->getTimeSlots();
		$this->render();
	}
}
