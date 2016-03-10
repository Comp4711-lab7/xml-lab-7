<?php

    class Timetable extends CI_Model {
        public $xml = null;
        protected $daysofweek = array();
        protected $courses = array();
        protected $periods = array();

        public function __construct() {
            $i = 0;
            $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
             foreach ($this->xml->daysofweek->day as $day) {
                $booking = array('day' => '', 'time' => '', 'coursename' =>'' , 
                                    'instructor' => '' , 'building' => '', 
                                    'room' => '', 'type' => '');
                //echo "<pre>";
                //var_dump($day);
               // echo "</pre>";

                foreach($day->booking as $b){
                        $booking['day'] = (string)$day['name'];
                        $booking['time'] = (string)$b['time'];
                        $booking['coursename'] = (string)$b->coursename;
                        $booking['instructor'] = (string)$b->instructor;
                        $booking['building'] = (string)$b->building;
                        $booking['room'] = (string)$b->room;
                        $booking['type'] = (string)$b->type;

                        $this->daysofweek[] =  new Booking($booking);
                }
             }
           // echo "<pre>";
             //var_dump($this->daysofweek);
             //var_dump($i);
            //echo "</pre>";
        }

        public function getDaysInWeek() {
            return $this->daysofweek;
        }
    }
    
    
    class Booking extends CI_Model {
        //protected $xml = null;
        public $day;
        public $time;
        public $coursename;
        public $instructor;
        public $building;
        public $room;
        public $type;

    public function __construct($booking) {
        
        //echo "Constructing";
        //$this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        $this->day = (string) $booking['day'];
        $this->time = (string) $booking['time'];
        $this->coursename = (string) $booking['coursename'];
        $this->instructor = (string) $booking['instructor'];
        $this->building = (string) $booking['building'];
        $this->room = (string) $booking['room'];
        $this->type = (string) $booking['type'];
    }

}