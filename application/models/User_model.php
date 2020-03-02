<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

  function getTableData($table, $active = '')
  {
    if (!empty($active)) {
      $this->db->where('Active', 1);
    }
    $q = $this->db->get($table);
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return 0;
    }
  }

  function getUserdetails($UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    $this->db->join('company', 'company.CompanyUID = users.CompanyUID', 'LEFT');
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return $q->row();
    } else {
      return 0;
    }
  }

  function getUserByRole($Role)
  {
    // if ($this->session->userdata('Role') == 2) {
    //   $this->db->where('CreatedBy', $this->session->userdata('UserUID'));
    // }
    if (!empty($Role)) {
      $this->db->where('Role', $Role);
    }
    $this->db->where('IsApproved', 1);
    $this->db->select('*, users.FullName, IC_Details.	ICNumber');
    $this->db->join('company', 'company.CompanyUID = users.CompanyUID', 'LEFT');
    $this->db->join('IC_Details', 'IC_Details.FullName = users.UserUID', 'LEFT');
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return array();
    }
  }

  function SaveUser($data)
  {
    $this->db->select('UserUID');
    $this->db->where('UserName', $data['UserName']);
    $this->db->or_where('EmailAddress1', $data['EmailAddress1']);
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return 2;
    } else {
      if ($this->db->insert('users', $data)) {
        $user = $this->db->insert_id();
        return 1;
      } else {
        return 0;
      }
    }
  }

  function ProcessUpdate($UserUID, $data)
  {
    $this->db->where('UserUID', $UserUID);
    if ($this->db->update('users', $data)) {
      return 1;
    } else {
      return 0;
    }
  }

  function DeleteUser($UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    if ($this->db->delete('users')) {
      return 1;
    } else {
      return 0;
    }
  }

  function UpdateUser($data, $UserUID)
  {
    $this->db->select('UserUID');
    $this->db->where('UserName', $data['UserName']);
    $this->db->where('Role', $data['Role']);
    $this->db->where("UserUID !=" . $UserUID);
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return 2;
    } else {
      $this->db->where('UserUID', $UserUID);
      if ($this->db->update('users', $data)) {
        return 1;
      } else {
        return 0;
      }
    }
  }

  function updatepassword($data, $UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    if ($this->db->update('users', $data)) {
      return 1;
    } else {
      return 0;
    }
  }

  function getApprovalPending()
  {
    $this->db->where('IsApproved', 0);
    // $this->db->join('vechicletype', 'vechicletype.TypeID = users.VType', 'LEFT');
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return array();
    }
  }

  function GetUsers($Role = '')
  {
    if (!empty($Role)) {
      $this->db->where('Role', $Role);
    }
    if ($this->session->userdata('Role') == 2) {
      $this->db->where('CreatedBy', $this->session->userdata('UserUID'));
    }
    $this->db->where('IsApproved', 1);
    $q = $this->db->get('users');
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return 0;
    }
  }

  function GetUsersDetailsByUserID($UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    $q = $this->db->get('users');
    return $q->row();
  }

  function deleteUsersDetailsByUserID($UserUID)
  {
    $this->db->where('UserUID', $UserUID);
    if ($this->db->delete('users')) {
      return 1;
    } else {
      return 0;
    }
  }

  function GetUsersOnly()
  {
    $data['Roles'] = 'User';
    $this->db->where('IsApproved', 1);
    $q = $this->db->get_where('users', $data);
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return 0;
    }
  }


  function GetSupplierGroups()
  {
    $query =  $this->db->get_where('supplier_groups', ['Active', 1]);
    return $query->result();
  }

  function GetSupplierGroupID($Id)
  {
    $this->db->where('Id', $Id);
    $q = $this->db->get('supplier_groups');
    return $q->row();
  }

  function SaveSupplierGroup($data)
  {
    $this->db->select('Id');
    $this->db->where('GroupName', $data['GroupName']);
    $q = $this->db->get('supplier_groups');
    if ($q->num_rows() == 0) {
      if ($this->db->insert('supplier_groups', $data)) {
        return true;
      }
    } else {
      return false;
    }
  }

  function UpdateSupplierGroup($data)
  {
    $this->db->select('Id');
    $this->db->where('GroupName', $data['GroupName']);
    $this->db->where('Id !=', $data['Id']);
    $q = $this->db->get('supplier_groups');

    if ($q->num_rows() == 0) {
      $this->db->reset_query();
      $this->db->where('Id', $data['Id']);
      if ($this->db->update('supplier_groups', $data)) {
        return true;
      }
    } else {
      return false;
    }
  }

  function DeleteSupplierGroup($Id)
  {
    $this->db->select('Id');
    $this->db->where('Id', $Id);
    $q = $this->db->get('supplier_groups');

    if ($q->num_rows() > 0) {
      $this->db->where('Id', $Id);
      if ($this->db->delete('supplier_groups')) {
        return true;
      }
    } else {
      return false;
    }
  }


  function getSupplierSlots($Id)
  {
    $query = $this->db->query("SELECT supplier_groups.AllotedTime FROM users INNER JOIN supplier_groups ON users.SupplierGroup = supplier_groups.Id WHERE users.UserUId = {$Id} AND supplier_groups.Active = 1");

    if ($query->num_rows() == 0) {
      return [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];
    } else {
      return json_decode($query->row()->AllotedTime);
    }
  }
}
