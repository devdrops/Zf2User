<?php

namespace Zf2User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Session\SessionManager;
    //Zend\Authentication\Storage\Session as SessionStorage;

use User\Form\Signin as SigninForm;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new SigninForm();
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $data = $request->getPost()->toArray();

                // Criando Storage para gravar sessão da authtenticação
                //$sessionStorage = new SessionStorage();
                $auth = new AuthenticationService();
                //$auth->setStorage($sessionStorage); // Definindo o SessionStorage para a auth

                $authAdapter = $this->getServiceLocator()->get('Zf2User\Auth\Adapter');
                $authAdapter->setUsername($data['username']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $user = $auth->getIdentity();
                    $userArray = $user['user'];
                    $storage = $auth->getStorage();
                    $storage->write($userArray,null);
                    $sessionManager = new SessionManager();
                    if (isset($data['rememberme'])) {
                        $time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
                        $sessionManager->rememberMe($time);
                    } else {
                        $time = 86400; // 1day
                        $sessionManager->rememberMe($time);
                    }

                    $redirect = $this->UserAuthentication()->getIdentity()->getRole()->getRedirect();
                    return $this->redirect()->toRoute($redirect);
                } else {
                    $messageResult = $result->getMessages();
                    $this->flashMessenger()->addMessage($messageResult[0]);
                    return $this->redirect()->toRoute('user-auth');
                }
            }
        }
        if ($this->UserAuthentication()->getIdentity()) {
            $redirect = $this->UserAuthentication()->getIdentity()->getRole()->getRedirect();
            return $this->redirect()->toRoute($redirect);
        } else {
            return new ViewModel(array(
                'form' => $form,
                'flashMessages' => $this->flashMessenger()->getMessages()
            ));
        }
    }

    public function logoutAction()
    {
        $auth = new AuthenticationService();
        $auth->clearIdentity();

        $sessionManager = new SessionManager();
        $sessionManager->forgetMe();

        return $this->redirect()->toRoute('user-auth');
    }

    public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');

        $userService = $this->getServiceLocator()->get('Zf2User\Service\User');
        $result = $userService->activate($activationKey);

        if($result)
            return new ViewModel(array('user'=>$result));
        else
            return new ViewModel();
    }
}
