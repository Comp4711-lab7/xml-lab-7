<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
		parent::__construct();
		$this->load->model('timetable');
	}

	public function index()
	{
		$this->data['title'] = 'XML Lab';
		$this->data['pagebody'] = 'welcome';
		$this->data['daysinweek'] = $this->timetable->getDaysInWeek();
		//$this->data['bookings'] = $this->timetable->getDaysBookings();
		//var_dump($this->data['daysinweek']);
		//echo '<pre>';
		//var_dump($this->data['daysinweek']);
		//echo '</pre>';
                //echo '<pre>';
		//var_dump($this->data['bookings']);
		//echo '</pre>';
		$this->render();

	}
}
