<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;

class ContactsController extends AppController
{
    public function index()
    {
        $contacts = $this->Contacts->find('all', ['contain' => ['Companies']]);

        $this->set([
            'contacts' => $contacts,
            '_serialize' => ['contacts']
        ]);
    }

    public function view($id)
    {
        $recipe = $this->Contacts->get($id, ['contain' => ['Companies']]);
        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $recipe = $this->Contacts->newEntity($this->request->getData());
        if ($this->Contacts->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
            '_serialize' => ['message', 'recipe']
        ]);
    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $recipe = $this->Contacts->get($id);
        $recipe = $this->Contacts->patchEntity($recipe, $this->request->getData());
        if ($this->Contacts->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $recipe = $this->Contacts->get($id);
        $message = 'Deleted';
        if (!$this->Contacts->delete($recipe)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}