<?php

    class Timetable extends CI_Model {
        public $xml = null;
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

            foreach ($this->xml->daysofweek->day->booking as $booking) {
                $this->bookings[(string) $booking['time']] = $booking;
            }

            //foreach ($this->daysinweek as $book) {
            //    $this->bookings[(string) $book['time']] = $book;
            //}
        }

        public function getDaysInWeek() {
            return $this->daysinweek;
        }

        public function getDaysBookings() {
            return $this->bookings;
        }
    }