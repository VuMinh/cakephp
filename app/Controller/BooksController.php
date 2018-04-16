<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class BooksController extends AppController
{
    public $components= array('RequestHandler');
    public function index()
    {
        $data = $this->Book->find('all');
        $this->set('data', $data);
//        var_dump(json_encode($data));
//        var_dump(count($data));
//        die;
    }

    public function index2(){
        $data= $this->Book->find('all',array(
            'condition'=>array('id >'=>5),
            'limit'=>4,
        ));
        $this->set('data',$data);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Not item');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('data', $this->Book->findById($id));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            //save new book
            if ($this->Book->save($this->request->data)) {
                $this->Session->setFlash('Book was added');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Item not add');
            }

        }
        $this->set('title_for_layout','Add new item');
    }

    public function edit()
    {
        // get id
        $id = $this->request->params['pass'][0];
        //set id
        $this->Book->id = $id;
        if ($this->Book->exists()) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                save use
                if ($this->Book->save($this->request->data)) {
                    $this->Session->setFlash('Item Updated');
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash('Unable update, Please try again');
                }
            }else{
                $this->request->data= $this->Book->read();
            }
        }else{
            $this->redirect(array('action'=>'index'));
        }
    }

    public function delete(){
        $id= $this->request->params['pass'][0];
        if($this->request->is('get')){
            $this->Session->setFlash('Delete method not allow');
            $this->redirect(array('action'=>'index'));
        }else{
            if(!$id){
                $this->Session->setFlash('id Book is not valid');
                $this->redirect(array('action'=>'index'));
            }else{
                //delete item
                if($this->Book->delete($id)){
                    $this->Session->setFlash('Item was deleted');
                    $this->redirect(array('action'=>'index'));
                }else{
                    $this->Session->setFlash('Unable deleted item');
                    $this->redirect(array('action'=>'index'));
                }
            }
        }
    }

    public function post(){
        $this->set(compact('posts','comments'));
    }

}
