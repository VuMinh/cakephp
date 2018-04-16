<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/11/2018
 * Time: 3:15 PM
 */
App::uses('AppModel', 'Model');

class User extends AppModel
{
    var $name = 'User';

    public function checkLogin($username, $password)
    {
        $sql = "Select username,password from users where username='$username' AND password ='$password'";;
        $this->query($sql);
        if ($this->getNumRows() == 0) {
            return false;
        }
        return true;
    }

    public function validateUser()
    {
        $this->validate = array(
            'username' => array(
                "rule1" => array(
                    "rule" => "notBlank",
                    "message" => "Username không được rỗng",
                ),
                "rule2" => array(
                    "rule" => "/^[a-z0-9_.]{4,}$/i",
                    "message" => "Username là kí tự hoặc số",
                ),
                "rule3" => array(
                    "rule" => "checkUsername", //call function checkUsername
                    "message" => "Username đã có người đăng kí",
                ),
            ),
            "pass" => array(
                "rule" => "notBlank",
                "message" => "password không được để trống",
                "on" => "create"
            ),
            "re_pass" => array(
                "rule1" => array(
                    "rule" => "notBlank",
                    "message" => "Password confirm không được trống",
                    "on" => "create"
                ),
                "match" => array(
                    "rule" => "ComparePass", //call function Compare Pass
                    "message" => "Password confirm không trùng khớp",
                ),
            ),
            "level" => array(
                "rule" => "notBlank",
                "message" => "Please select level"
            ),
            "name" => array(
                "not empty" => array(
                    'rule' => 'notBlank',
                    'message' => "Name không được để trống"
                )
            ),
            "email" => array(
                "rule" => "email",
                "message" => "Email is not available"
            )
        );

        if ($this->validates($this->validate))
            return true;
        else
            return false;
    }

    public function ComparePass()
    {
        if ($this->data['User']['pass'] != $this->data['User']['re_pass']) {
            return false;
        } else {
            return true;
        }
    }

    public function checkUsername()
    {
        if (isset($this->data['User']['id'])) {
            $where = array(
                "id !=" => $this->data['User']['id'],
                "username" => $this->data['User']['username']
            );
        } else {
            $where = array(
                'username' => $this->data['User']['username']
            );
        }
        $this->find('first', array(
            'conditions' => $where
        ));
        $count = $this->getNumRows();
        if ($count != 0) {
            return false;
        } else
            return true;
    }

    public function beforeSave($options = array())
    {
        if (!empty($this->data['User']['pass'])) {
            $hash = Security::hash($this->data['User']['pass'], 'md5');
            $this->data['User']['password'] = $hash;
        }
        return true;
    }

}