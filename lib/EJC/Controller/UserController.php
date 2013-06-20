<?php

namespace EJC\Controller;

/**
 * Controller fuer den User
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
class UserController extends AbstractController {

    /**
     * Zeige die Uebersichtsseite des Users
     *
     * @return void
     */
    public function startAction() {
        $openProjects = $this->projectRepository->findOpenByUser($this->getCurrentUser());
        $openTasks = $this->taskRepository->findOpenByuser($this->getCurrentUser());
        $this->view->assign('title', 'Startseite');
        $this->view->assign('openProjects', $openProjects);
        $this->view->assign('openTasks', $openTasks);
        $this->view->render();
    }

    /**
     * Zeige eine Liste aller User
     *
     * @return void
     */
    public function listAction() {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
        $this->view->render();
    }

    /**
     * Anzeigen der Benutzereinstellungen
     *
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @return void
     */
    public function showSettingsAction() {
        $this->view->assign('user', $this->getCurrentUser());
        $this->view->render();
    }

    /**
     * Zeige das Formular fuer das Erstellen eines neuen Users
     *
     * @return void
     */
    public function newAction() {
        // Wenn es sich nicht um einen Admin handelt abbrechen
        if (!$this->getCurrentUser()->getAdmin()) exit;

        $newUser = new \EJC\Model\User();
        $this->view->assign('user', $newUser);
        $this->view->render();
    }

    /**
     * Erstelle einen neuen User
     *
     * @param \EJC\Model\User $user
     * @return void
     */
    public function createAction(\EJC\Model\User $newUser) {
        // Wenn es sich nicht um einen Admin handelt abbrechen
        if (!$this->getCurrentUser()->getAdmin()) exit;

        $params = $this->request->getParams();
        if (md5($params['passwordConfirm']) === $newUser->getPassword()) {
            $this->userRepository->add($newUser);
            $this->forward('User', 'showSettings');
            return;
        } elseif(empty($params['passwordConfirm'])) {
            $this->view->addErrorMessage('Geben Sie ein Passwort an');
        } else {
            $this->view->addErrorMessage('Die Passw&ouml;rter stimmen nicht &uuml;berein');
        }
        $this->forward('User', 'new', array('newUser' => $newUser));
    }

    /**
     * Anzeigen des Formulars zum Bearbeiten der Benutzerdaten
     *
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @param \EJC\Model\User $user
     * @return void
     */
    public function editAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        } else {
            if (!$this->getCurrentUser()->getAdmin()) {
                // wenn kein Admin duerfen keine fremden Userdaten editiert werden
                header('HTTP/1.1 403 Forbidden');
                exit;
            }
        }
        $this->view->assign('user', $user);
        $this->view->render();
    }

    /**
     * Anzeigen des Formulars zum Aendern des Passworts
     *
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @param \EJC\Model\User $user
     */
    public function editPasswordAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        } else {
            if (!$this->getCurrentUser()->getAdmin()) {
                // wenn kein Admin duerfen keine fremden Userdaten editiert werden
                header('HTTP/1.1 403 Forbidden');
                exit;
            }
        }
        $this->view->assign('user', $user);
        $this->view->render();
    }

    /**
     * Aktualisiere die Daten des Users in DB und Session
     *
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @param \EJC\Model\User $user
     */
    public function updateAction(\EJC\Model\User $user) {
        if ($user->getId() !== $this->getCurrentUser()->getId() || !$this->getCurrentUser()->getAdmin()) {
            // wenn kein Admin duerfen keine fremden Userdaten editiert werden
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
        $this->userRepository->update($user);
        $_SESSION['user'] = serialize($user);
        $this->forward('User', 'showSettings');
    }

    /**
     * Aktualisiere das Passwort des Users in DB und Session
     *
     * @param \EJC\Model\User $user
     */
    public function updatePasswordAction(\EJC\Model\User $user) {
        if ($user->getId() !== $this->getCurrentUser->getId()) {
            // nur der Benutzer selbst kann sein Passwort aendern
            header('HTTP/1.1 403 Forbidden');
            exit;
        }

        $params = $this->request->getParams();
        if (md5($params['oldPassword']) !== $user->getPassword()) {
            $this->view->addErrorMessage('Sie haben ihr aktuelles Passwort falsch angegeben');
            $this->forward('User', 'editPassword', array('user' => $user));
            return;
        }
        if (empty($params['newPassword'])) {
            $this->view->addErrorMessage('Geben Sie ein neues Passwort an');
            $this->forward('User', 'editPassword', array('user' => $user));
            return;
        }
        $user->setPassword($params['newPassword']);
        $this->userRepository->update($user);
        $_SESSION['user'] = serialize($user);
        $this->forward('User', 'showSettings');
    }

    /**
     * Zeige Formular um ein neues Passwort anzufordern
     *
     * @return void
     */
    public function requestNewPasswordAction() {
        $this->view->assign('title', 'Neues Passwort anfordern');
        $this->view->render();
    }

    /**
     * Versende ein neues Passwort an die in den Benutzerdaten angegebene
     * E-Mail-Adresse
     *
     * @return void
     */
    public function sendNewPasswordAction() {
        $user = $this->userRepository->findByEmail();
        if ($user === NULL) {
            $this->view->addErrorMessage('Es wurde kein User zu der E-Mail-Adresse gefunden.');
            $this->forward('User', 'requestNewPassword');
        } else {
            $this->view->assign('title', 'Passwort wurde verschickt');
            $this->view->render();
        }
    }

    /**
     * Zeige das Login-Formular
     *
     * @return void
     */
    public function showLoginAction() {
        $this->view->assign('title', 'Login');
        $this->view->render();
    }

    /**
     * Logge den User ein
     *
     * @return void
     */
    public function loginAction(array $login) {

        // Hole passenden User aus dem Repository
        try {
            $user = $this->userRepository->findOneByName($login['name']);
        } catch (EJC\Exception\RepositoryException $e) {
            $user = NULL;
        }

        // Wenn User nicht gefunden, gib Fehlermeldung aus
        if ($user === NULL) {
            $this->view->addErrorMessage('User nicht gefunden');
            $this->forward('User', 'showLogin');
            return;
        } else {
            // Wenn Username + Passwort passen, leite auf User-Startseite weiter
            // Setze Login-Status in der User-Session
            if ($user->getPassword() === md5($login['password'])) {
                $_SESSION['user'] = serialize($user);
                $_SESSION['login'] = time();
                $this->forward('User', 'start');
            } else {
                // Falsches Passwort - Fehlermeldung anzeigen
                $this->view->addErrorMessage('Falsches Passwort');
                $this->forward('User', 'showLogin');
                return;
            }
        }
    }

    /**
    * Logge den User aus
    * Loesche die aktuelle Session des Users und leite Ihn auf die Startseite weiter.
    *
    * @author: Enrico Lauterschlag <enrico.lauterschlag@web.de>
    * @return void
    */
    public function logoutAction() {
    	session_destroy();
    	header('Location: .');
    	exit;
    }

}

?>