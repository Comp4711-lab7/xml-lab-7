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
        $this->data['title'] = 'CST Web and Mobile Time Table';
        $this->data['pagebody'] = 'welcome';
        $this->data['daysofweek'] = $this->timetable->getDaysOfWeek();
        $this->data['periods'] = $this->timetable->getPeriods();
        $this->data['courses'] = $this->timetable->getCourses();
        $this->data['daysearch'] = form_dropdown('day', $this->timetable->getDays());
        $this->data['timeslotsearch'] = form_dropdown('time', $this->timetable->getTimeSlots());
        $this->render();
    }

    /**
     * Find the bookings with specified days the time in each facets
     */
    function results()
    {
        //find bookings in each facet
        $c = $this->timetable->searchCourses($this->input->post('day'), $this->input->post('time'));
        $p = $this->timetable->searchPeriods($this->input->post('day'), $this->input->post('time'));
        $d = $this->timetable->searchDaysOfWeek($this->input->post('day'), $this->input->post('time'));
        $this->data['cResult'] = "no results";
        $this->data['pResult'] = "no results";
        $this->data['dResult'] = "no results";

        //check if result is null
        // set courses, periods, daysofweek data to empty array if their searched returns null
        if ($c) {
            $this->data['courses'] = $this->BookingToString($c);
            $this->data['cResult'] = "";
        }else{
            $this->data['courses'] = array();
        }
        if ($p) {
            $this->data['periods'] = $this->BookingToString($p);
            $this->data['pResult'] = "";
        }else{
            $this->data['periods'] = array();
        }
        if ($d) {
            $this->data['daysofweek'] = $this->BookingToString($d);
            $this->data['dResult'] = "";
        }else{
            $this->data['daysofweek'] = array();
        }

        //check if any of the search returns null
        $this->data['bingo'] = "NOT A BINGO";
        if ($this->data['cResult'] != "no results" && $this->data['pResult'] != "no results" && $this->data['dResult'] != "no results") {
            $this->data['bingo'] = "BINGO";
        }

        $this->data['title'] = 'Search Results';
        $this->data['pagebody'] = 'results';

        $this->render();
    }


    /**
     * Convert booking to String for rendering in the view
     * @param $booking
     * @return array
     */
    public function BookingToString($booking)
    {
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
