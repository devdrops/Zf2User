<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Controller;

use Zend\View\Model\ViewModel;
use Zf2Base\Controller\CrudController;

class IndexController extends CrudController
{
    public function __construct()
    {
        $this->entity = "Zf2User\Entity\User";
        $this->form = "Zf2User\Form\User";
        $this->service = "Zf2User\Service\User";
        $this->controller = "index";
        $this->route = "user-admin";
    }

    public function registerAction()
    {
        // pega o ID
        $id = $this->params()->fromRoute('id',0);

        // New formulario
        $form = new $this->form('register_user', array('id' => $id, 'em' => $this->getEm()));
        // request posts
        $request = $this->getRequest();

        // se ID existir da um setData para popular o formulario
        if($id) {
            // com o id efetuar uma busca no banco de dados para popular o form
            $repository = $this->getEm()->getRepository($this->entity);
            $entity = $repository->find($this->params()->fromRoute('id',0))->toArray();
            unset($entity['password']);

            // popula o form
            $form->setData($entity);
        }

        // verifica se ahh post
        if($request->isPost())
        {
            // popula o form com os dados do post
            $form->setData($request->getPost());
            // valida os mesmos
            if($form->isValid())
            {
                //try {
                    $id = $this->params()->fromRoute('id',$request->getPost('id', 0));
                    $service = $this->getServiceLocator()->get($this->service);
                    if ($service->persist($request->getPost()->toArray(), $id))
                        $this->flashMessenger()->addMessage('Salvo com sucesso!');

                // } catch (\Exception $e) {
                //     $this->flashMessenger()->addMessage('Falha ao salvar!');
                // }

                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array(
            'form' => $form,
            'id' => $id
        ));
    }
}
