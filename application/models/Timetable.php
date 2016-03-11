<?php
class Timetable extends CI_Model {
    public $xml = null;
    protected $daysofweek = array();
    protected $courses = array();
    protected $periods = array();
    public function __construct() {
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        $this->setDaysInWeek();
        $this->setPeriods();
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

    private function setPeriods(){
        foreach ($this->xml->periods->timeslot as $slot) {
            foreach ($slot->booking as $b) {
                $booking = array();
                $booking['day'] = (string) $b['day'];
                $booking['time'] = (string) $slot['time'];
                $booking['coursename'] = (string) $b->coursename;
                $booking['instructor'] = (string) $b->instructor;
                $booking['building'] = (string) $b->building;
                $booking['room'] = (string) $b->room;
                $booking['type'] = (string) $b->type;
                $this->periods[] = new Booking($booking);
            }
        }
    }
    public function getDaysOfWeek() {
        return $this->daysofweek;
    }

    public function getPeriods(){
        return $this->periods;
    }

    public function getCourses(){
        return $this->courses;
    }
    
    
    public function getDays() {
        
        $days = array('Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday');
        return $days;
        
    }
    
    public function getTimeSlots(){
        $timeslots = array (
            "8:30-10:20" => "8:30am to 10:20am",
            "9:30-11:20" => "9:30am to 11:20am",
            "10:30-12:20" => "10:30am to 12:20pm",
            "11:30-12:20" => "11:30am to 12:20pm",
            "12:30-2:20" => "12:30pm to 2:20pm",
            "2:30-3:20" => "2:30pm to 3:20pm",
            "3:30-5:20" => "3:30pm to 5:20pm",
            "1:30-2:20" => "1:30pm to 2:20pm",
            "12:30-1:20" => "12:30pm to 1:20pm",
            "2:30-5:20" => "2:30pm to 5:20pm"
            );
            
        return $timeslots;
        
        
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
