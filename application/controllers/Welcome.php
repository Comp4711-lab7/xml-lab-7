<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

    function __construct()
    {
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
        $this->data['daysearch'] = form_dropdown('day', $this->timetable->getDays());
        $this->data['timeslotsearch'] = form_dropdown('time', $this->timetable->getTimeSlots());
        $this->render();
    }

    function results()
    {
        $c = $this->timetable->searchCourses($this->input->post('day'), $this->input->post('time'));
        $p = $this->timetable->searchPeriods($this->input->post('day'), $this->input->post('time'));
        $d = $this->timetable->searchDaysOfWeek($this->input->post('day'), $this->input->post('time'));
//        $this->data['courses'] = "no results";
//        $this->data['periods'] = "no results";
//        $this->data['daysofweek'] = "no results";

        if ($c) {
            $this->data['courses'] = $this->BookingToString($c);
        }else{
            $this->data['courses'] = array();
        }
        if ($p) {
            $this->data['periods'] = $this->BookingToString($p);
        }else{
            $this->data['periods'] = array();
        }
        if ($d) {
            $this->data['daysofweek'] = $this->BookingToString($d);
        }else{
            $this->data['daysofweek'] = array();
        }

//        $this->data['bingo'] = "NOT A BINGO";
//        if ($this->data['courses'] != "no results" && $this->data['periods'] != "no results" && $this->data['daysofweek'] != "no results") {
//            $this->data['bingo'] = "BINGO";
//        }

        $this->data['title'] = 'XML Lab Results';
        $this->data['pagebody'] = 'results';

        // call search function

        $this->render();
    }


    public function BookingToString($booking)
    {
//        $string = "COURSE: " . $booking->coursename . PHP_EOL
//            . $booking->day . " : " . $booking->time . PHP_EOL
//            . $booking->instructor . PHP_EOL
//            . $booking->building . " : " . $booking->room . PHP_EOL
//            . $booking->type;
//        return $string;
        $b = array();
        $b['day'] = (string) $booking->day;
        $b['time'] = (string) $booking->time;
        $b['coursename'] = (string) $booking->coursename;
        $b['instructor'] = (string) $booking->instructor;
        $b['building'] = (string) $booking->building;
        $b['room'] = (string) $booking->room;
        $b['type'] = (string) $booking->type;

        return array($b);

    }
}
