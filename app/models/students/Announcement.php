<?php

class Announcement {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function viewAnnouncements(){
        $this->db->query('SELECT announcements.*, teachers.teacher_name FROM announcements INNER JOIN teachers on teachers.teacher_id = announcements.teacher_id ORDER BY announcements.ann_date_created DESC');
        $results = $this->db->resultSet();
        return $results;
    }
}
