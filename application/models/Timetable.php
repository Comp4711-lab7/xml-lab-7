<?php

class Timetable extends CI_Model {

    public $xml = null;
    protected $daysofweek = array();
    protected $courses = array();
    protected $periods = array();

    public function __construct() {
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        $this->setDaysInWeek();
        $this->setCourses();
    }


    private function setDaysInWeek() {
        foreach ($this->xml->daysofweek->day as $day) {
            foreach ($day->booking as $b) {
                $booking = array();
                $booking['day'] = (string) $day['name'];
                $booking['time'] = (string) $b['time'];
                $booking['coursename'] = (string) $b->coursename;
                $booking['instructor'] = (string) $b->instructor;
                $booking['building'] = (string) $b->building;
                $booking['room'] = (string) $b->room;
                $booking['type'] = (string) $b->type;
                $this->daysofweek[] = new Booking($booking);
            }
        }
    }
    
    private function setCourses(){
        foreach ($this->xml->courses->course as $course) {
            foreach ($course->booking as $b) {
                $booking = array();
                $booking['coursename'] = (string) $course['name'];
                $booking['time'] = (string) $b['time'];
                $booking['day'] = (string) $b->dayofweek;
                $booking['instructor'] = (string) $b->instructor;
                $booking['building'] = (string) $b->building;
                $booking['room'] = (string) $b->room;
                $booking['type'] = (string) $b->type;
                $this->courses[] = new Booking($booking);
            }
        }
    }
    
    private function setPeriods(){}

    public function getDaysOfWeek() {
        return $this->daysofweek;
    }
    
    public function getPeriods(){
        return $this->periods;
    }
    
    public function getCourses(){
        return $this->courses;
    }

}

class Booking extends CI_Model {

    public $day;
    public $time;
    public $coursename;
    public $instructor;
    public $building;
    public $room;
    public $type;

    public function __construct($booking) {
        $this->day = (string) $booking['day'];
        $this->time = (string) $booking['time'];
        $this->coursename = (string) $booking['coursename'];
        $this->instructor = (string) $booking['instructor'];
        $this->building = (string) $booking['building'];
        $this->room = (string) $booking['room'];
        $this->type = (string) $booking['type'];
    }

}
