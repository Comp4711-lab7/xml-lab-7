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
            
                
                $c = $this->timetable->searchCourses($this->input->post('day'), $this->input->post('time'));
                $p = $this->timetable->searchPeriods($this->input->post('day'), $this->input->post('time'));
                $d = $this->timetable->searchDaysOfWeek($this->input->post('day'), $this->input->post('time'));
                $this->data['cSearch'] = "no results";
                $this->data['pSearch'] = "no results";
                $this->data['dSearch'] = "no results";
                    if($c){
                        $this->data['cSearch'] = $this->BookingToString($c);
                    }
                    if($p){
                        $this->data['pSearch'] = $this->BookingToString($p);
                    }
                    if($d){
                        $this->data['dSearch'] = $this->BookingToString($d);
                    }
                
                $this->data['bingo'] = "NOT A BINGO";
                if($this->data['cSearch'] != "no results" && $this->data['pSearch'] != "no results" && $this->data['dSearch'] != "no results"){
                    $this->data['bingo'] = "BINGO";
                }
                
		$this->data['title'] = 'XML Lab Results';
		$this->data['pagebody'] = 'results';

		// call search function

		$this->render();
	}
        
        
            public function BookingToString($booking){
                $string = "COURSE: " . $booking->coursename . PHP_EOL  
                        . $booking->day  . " : " . $booking->time . PHP_EOL  
                        . $booking->instructor . PHP_EOL  
                        . $booking->building . " : " . $booking->room . PHP_EOL  
                        . $booking->type;
                return $string;
                
    }
}
