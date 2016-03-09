<?php

    class Bookings extends CI_Model {
        protected $xml = null;


        public function __construct() {
            $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        }

    }
