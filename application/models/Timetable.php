<?php

    class Timetable extends CI_Model {
        protected $xml = null;
        protected $daysinweek = array();
        protected $coursenames = array();
        protected $instructors = array();
        protected $buildings = array();
        protected $bookings = array();
        protected $rooms = array();
        protected $types = array();

        public function __construct() {
            $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');

            // Populate days of the week
            foreach ($this->xml->daysofweek->day as $day) {
                $this->daysinweek[(string) $day['name']] = $day;
            }

            foreach ($this->daysinweek->bookings as $book) {
                $this->daysinweek[(string) $day['time']] = $book;
            }
        }

    }