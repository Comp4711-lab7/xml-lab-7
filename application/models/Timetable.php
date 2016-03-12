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
            "8:30-10:20" => "8:30 to 10:20",
            "9:30-11:20" => "9:30 to 11:20",
            "10:30-12:20" => "10:30 to 12:20",
            "11:30-12:20" => "11:30 to 12:20",
            "12:30-14:20" => "12:30 to 14:20",
            "14:30-15:20" => "14:30 to 15:20",
            "15:30-17:20" => "15:30 to 17:20",
            "13:30-14:20" => "13:30 to 14:20",
            "12:30-13:20" => "12:30 to 13:20",
            "14:30-17:20" => "14:30 to 17:20"
            );    
        return $timeslots;
    }

    public function searchDaysOfWeek($day, $timeslot){
        foreach($this->daysofweek as $booking){
            if($booking->day == $day && $booking->time == $timeslot){
                return $booking;
            }
        }
    }
    
    public function searchCourses($day, $timeslot){
        foreach($this->courses as $booking){
            if($booking->day == $day && $booking->time == $timeslot){
                    return $booking;
            }
        }
    }
    
    public function searchPeriods($day, $timeslot){
        foreach($this->periods as $booking){
            if($booking->day == $day && $booking->time == $timeslot){
                    return $booking;
            }
        }
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
