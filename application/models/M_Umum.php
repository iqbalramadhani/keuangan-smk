<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Umum extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     public function insert($table, $data, $last_id = false)
     {
          $this->db->insert($table, $data, true);
          if ($this->db->affected_rows() > 0) {
               if ($last_id) {
                    return $this->db->insert_id();
               } else {
                    return true;
               }
          } else {
               return false;
          }
     }

     public function multi_insert($table, $data)
     {
          $this->db->insert_batch($table, $data, true);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function get_data($table, $select = false)
     {
          if ($select != false) {
               $this->db->select($select);
               $this->db->from($table);
               return $this->db->get();
          }
          return $this->db->get($table);
     }

     public function get_where($table, $data, $select = false)
     {
          if ($select == false) {
               return $this->db->get_where($table, $data);
          } else {
               return $this->db->select($select)->from($table)->where($data)->get();
          }
     }

     public function update($table, $data, $where)
     {
          $query  = $this->db->update($table, $data, $where, true);
          if ($query) {
               return true;
          } else {
               return false;
          }
     }

     public function delete($table, $where)
     {
          $this->db->delete($table, $where);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }
}
