<?php
App::uses('AppController', 'Controller');
/**
 * Friendships Controller
 *
 */
class FriendshipsController extends AppController {

  function add() {
    if ($this->request->is('post')) {
      $this->Friendship->create();
      if ($this->Friendship->save($this->request->data)) {
        $this->Session->setFlash('Friend request has been sent');
        $this->redirect($this->referer());
      } else {
        $validationErrors = $this->Friendship->invalidFields();
        $this->Session->setFlash($validationErrors['user_id'][0]);
        $this->redirect($this->referer());
      }
    }
  }

  function approve($id = null) {
    if (!$id) {
      throw new NotFoundException(__('Invalid friendship'));
    }

    $friendship = $this->Friendship->findById($id);
    if (!$friendship || $friendship["Friendship"]["friend_id"] != $this->Auth->user('id')) { //check if current_user
      $this->Session->setFlash('Unable to approve.');
      $this->redirect($this->referer());
    }
    if ($this->request->is('post') || $this->request->is('put')) {
      $this->Friendship->id = $id;
      if ($this->Frienship->transition($this->request->data["event"])) {
        $this->Session->setFlash('Friendship updated');
        $this->redirect($this->referer());
      } else {
        $this->Session->setFlash('Unable to update.');
      }
    }

    if (!$this->request->data) {
      $this->request->data = $friendship;
    }
  }

  function delete($id) {

  }
}
