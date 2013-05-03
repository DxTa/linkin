<?php
App::uses('AppController', 'Controller');
/**
 * Friendships Controller
 *
 */
class FriendshipsController extends AppController {

  function add() {
    if ($this->request->is('post')) {
      $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
      $this->autoLayout = false;
      $this->autoRender = false;
      $behaviors = $this->Friendship->Behaviors->loaded();
      $this->Friendship->create();
      if ($this->Friendship->save($this->request->data)) {
        $response = array('success' => true);
        $response['data'] = '<button class="friendship-act" user="'.$this->request->data['Friendship']['user_id'].'"friend="'.$this->request->data['Friendship']['friend_id'].'" event="pending" onclick="friendRequest(this)">Pending</button>';
      } else {
        $response = array('success' => false);
      }
      $this->header('Content-Type: application/json');
      echo json_encode($response);
    }
  }

  function edit($id = null) {
    if (!$id) {
      throw new NotFoundException(__('Invalid friendship'));
    }

    if ($this->request->is('post') || $this->request->is('put')) {
      $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
      $this->autoLayout = false;
      $this->autoRender = false;
      $friendship = $this->Friendship->findById($id);
      if (!$friendship || ($friendship["Friendship"]["friend_id"] != $this->Auth->user('id') && $this->request->data["Friendship"]["event"] != "destroy")) { // current_user cannot approve frienship
        $response = array('success' => false);
      } else {
        $this->Friendship->id = $id;
        if ($this->Friendship->transition($this->request->data["Friendship"]["event"])) {
          $response = array('success' => true);
          if ($this->request->data['Friendship']['event'] == 'approve') {
            $response['data'] = '<button class="friendship-act" user="'.$this->request->data['Friendship']['user_id'].'"friend="'.$this->request->data['Friendship']['friend_id'].'" event="destroy" action="edit" onclick="friendRequest(this)">Unfriend</button>';
          } else {
            $friend_id = $this->Auth->User('id') == $this->request->data['Friendship']['user_id'] ? $this->request->data['Friendship']['friend_id'] : $this->request->data['Friendship']['user_id'];
            $response['data'] = '<button class="friendship-act" user="'.$this->Auth->User('id').'"friend="'.$friend_id.'" action="add" onclick="friendRequest(this)">Add Friend</button>';
          }
        } else {
          $response = array('success' => false);
        }
      }
      $this->header('Content-Type: application/json');
      echo json_encode($response);
    }
  }

}
