<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/13/2018
 * Time: 11:42 AM
 */
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $name = 'Users'; // Name of Controller
    var $helper = array("Html", "Session");
    var $components = array("Session");

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function index()
    {
        // code here
        $data = $this->User->find('all');
        $this->set('data', $data);
    }

    public function admin_index()
    {
        $data = $this->User->find('all');
        $this->set('data', $data);
    }

    public function admin_edit($id)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash('User này không phù hợp');
            $this->redirect('/admin/users'); // chuyển đến link: admin/users/index
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id); //lấy thông tin user
        } else {
            $this->User->set($this->data);
            if ($this->User->validateUser()) {
                $this->User->save($this->data);
                $this->Session->setFlash('Cập nhật User thành công');
                $this->redirect('/admin/users');
            }
        }

    }

    function admin_add()
    {
        if (!empty($this->data)) {
            $this->User->set($this->data);
            if ($this->User->validateUser()) {
                $this->User->save($this->data);
                $this->Session->setFlash('Thêm user thành công');
                $this->redirect('/admin/users');
            } else {
                $this->render();
            }
        }
    }

    function admin_delete($user_id)
    {
        if (isset($user_id) && is_numeric($user_id)) {
            $data = $this->User->read(null, $user_id);
            if (!empty($data)) {
                $this->User->delete($user_id);
                $this->Session->setFlash('User đã được xóa với id=' . $user_id);
            } else {
                $this->Session->setFlash('User không tồn tại');
            }
        } else {
            $this->Session->setFlash('User không tồn tại');
        }
        $this->redirect('/admin/users');
    }

    public function login()
    {
        /*$error = "";
        if (isset($_POST['ok'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            if ($this->User->checkLogin($username, $password)) {
                $this->Session->write('session', $username);
                $this->redirect("info");
            }else{
                $error="Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
        $this->set('error', $error);*/

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('level') == 1) {
                    $this->redirect('/admin/users/index');
                } else {
                    $this->redirect('/users/index');
                }
            } else {
                $this->Session->setFlash('Username hoặc password sai', 'default', array('class' => 'alert alert-success'));
            }
        }
    }

    public function info()
    {
        if ($this->Session->check('session')) {
            $username = $this->Session->read('session');
            $this->set('name', $username);
        } else {
            $this->render('login');
        }
    }

    public function logout()
    {
//        $this->Session->delete('session');
//        $this->redirect('login');
        $this->redirect($this->Auth->logout());
    }

}