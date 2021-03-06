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
        $limitProject = isset($this->params['limitProject']) ? $this->params['limitProject'] : 0;
        $limitTask = isset($this->params['limitTask']) ? $this->params['limitTask'] : 0;
        $openProjects = $this->projectRepository->findOpenByUser($this->getCurrentUser(), $limitProject);
        $openTasks = $this->taskRepository->findOpenByuser($this->getCurrentUser(), $limitTask);
        $allOpenProjects = count($this->projectRepository->findOpenByUser($this->getCurrentUser()));
        $allOpenTasks = count($this->taskRepository->findOpenByuser($this->getCurrentUser()));
        $this->view->assign('title', 'Startseite');
        $this->view->assign('openProjects', $openProjects);
        $this->view->assign('allOpenProjects', $allOpenProjects);
        $this->view->assign('openTasks', $openTasks);
        $this->view->assign('allOpenTasks', $allOpenTasks);
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
    public function newAction(\EJC\Model\User $newUser = NULL) {
        // Wenn es sich nicht um einen Admin handelt abbrechen
        if (!$this->getCurrentUser()->getAdmin()) exit;
        if ($newUser === NULL) {
            $newUser = new \EJC\Model\User();
        }
        $this->view->assign('title', 'Neuen Benutzer anlegen');
        $this->view->assign('newUser', $newUser);
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

        // Pruefe ob username schon vergeben
        $existingUser = $this->userRepository->findOneByName($newUser->getName());
        if (is_object($existingUser)) {
            $this->view->addErrorMessage('Der Username ist schon vergeben');
            $this->forward('User', 'new', array('newUser' => $newUser));
        } else {
            $params = $this->request->getParams();
            if (empty($params['passwordConfirm']) || $newUser->getPassword() === NULL) {
                $this->view->addErrorMessage('Geben Sie ein Passwort an');
            } elseif ($newUser->getName() === '') {
                $this->view->addErrorMessage('Geben sie einen Usernamen an');
            } elseif ($newUser->getFirst_name() === '') {
                $this->view->addErrorMessage('Geben sie einen Vornamen an');
            } elseif ($newUser->getLast_name() === '') {
                $this->view->addErrorMessage('Geben sie einen Nachnamen an');
            } elseif ($newUser->getEmail() === false) {
                $this->view->addErrorMessage('Geben sie eine g&uuml;ltige E-Mail-Adress an');
            } elseif (md5($params['passwordConfirm']) !== $newUser->getPassword()) {
                $this->view->addErrorMessage('Die Passw&ouml;rter stimmen nicht &uuml;berein');
            }
            if (empty($this->view->errorMessages)) {
                $this->userRepository->add($newUser);
                $this->forward('User', 'showSettings');
            } else {
                $this->forward('User', 'new', array('newUser' => $newUser));
            }
        }
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
        $this->view->assign('admin', $this->getCurrentUser()->getAdmin());
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
        if ($user->getId() !== $this->getCurrentUser()->getId() && !$this->getCurrentUser()->getAdmin()) {
            // wenn kein Admin duerfen keine fremden Userdaten editiert werden
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
        $existingUser = $this->userRepository->findOneByName($user->getName());

        // Pruefe ob username schon vergeben
        if (is_object($existingUser) && $existingUser->getId() !== $user->getId()) {
            $this->view->addErrorMessage('Der Username ist schon vergeben');
            $this->forward('User', 'edit', array('user' => $user));
        } else {
            $this->userRepository->update($user);
            if ($this->getCurrentUser()->getId() === $user->getId()) {
                $_SESSION['user'] = serialize($user);
            }
            $this->redirect('User', 'showSettings');
        }
    }

    /**
     * Aktualisiere das Passwort des Users in DB und Session
     *
     * @param \EJC\Model\User $user
     */
    public function updatePasswordAction(\EJC\Model\User $user) {
        if ($user->getId() !== $this->getCurrentUser()->getId()) {
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
        $params = $this->request->getParams();
        if ($params['email'] === '') {
                $this->view->addErrorMessage('Geben sie eine E-Mail-Adresse an.');
                $this->forward('User', 'requestNewPassword');
        } else {
            $user = $this->userRepository->findOneByEmail($params['email']);
            if ($user === NULL) {
                $this->view->addErrorMessage('Es wurde kein User zu der E-Mail-Adresse gefunden.');
                $this->forward('User', 'requestNewPassword');
            } else {
                // Verschicke die Mail mit dem neuen Passwort
                $newPassword = \EJC\Helper\StringHelper::createPassword();
                $content = "Ihre neuen Nutzerdaten: \r\n\r\nUsername: " . $user->getName() . " \r\nPasswort: $newPassword";

                $mailSent = $this->sendMail($user->getEmail(), 'Ihr neues Passwort', $content);
                if (!$mailSent) {
                    $this->forward('User', 'requestNewPassword');
                } else {
                    $user->setPassword($newPassword);
                    $this->userRepository->update($user);

                    $this->view->assign('title', 'Passwort wurde verschickt');
                    $this->view->render();
                }
            }
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
    public function loginAction() {
        $login = $this->params['login'];
        if (!isset($this->params['login']) || ($this->params['login']['name'] === '' || $this->params['login']['password'] === '')) {
            session_destroy();
            $this->forward('User', 'showLogin');
        }
        // Hole passenden User aus dem Repository
        try {
            $user = $this->userRepository->findOneByName($login['name']);
            if ($user->getDisable()) $user = NULL;
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
                $this->redirect('User', 'start');
            } else {
                // Falsches Passwort - Fehlermeldung anzeigen
                $this->view->addErrorMessage('Falsches Passwort');
                $this->forward('User', 'showLogin');
                return;
            }
        }
    }

    /**
     * Zeige ein Formular fuer die Registrierung
     *
     * @return void
     */
    public function registerAction(\EJC\Model\User $newUser = NULL) {
        if ($newUser === NULL) {
            $newUser = new \EJC\Model\User();
        }
        $this->view->assign('title', 'Registrieren');
        $this->view->assign('newUser', $newUser);
        $this->view->render();
    }

    /**
     * Registriere einen neuen User
     *
     * @param \EJC\Model\User $newUser
     * @return void
     */
    public function createRegisteredAction(\EJC\Model\User $newUser) {
        // Pruefe ob username schon vergeben
        $existingUser = $this->userRepository->findOneByName($newUser->getName());
        if (is_object($existingUser)) {
            $this->view->addErrorMessage('Der Username ist schon vergeben');
            $this->forward('User', 'register', array('newUser' => $newUser));
        } else {
            $params = $this->request->getParams();
            // Fehlermeldungen ausgeben
            if ($newUser->getName() === '') $this->view->addErrorMessage('Geben sie einen Usernamen an');
            if ($newUser->getFirst_name() === '') $this->view->addErrorMessage('Geben sie einen Vornamen an');
            if ($newUser->getLast_name() === '') $this->view->addErrorMessage('Geben sie einen Nachnamen an');
            if ($newUser->getEmail() === FALSE) $this->view->addErrorMessage('Geben sie eine g&uuml;ltige E-Mail-Adresse an');
            if ($newUser->getPassword() === NULL) {
                $this->view->addErrorMessage('Geben sie ein Passwort an');
            } elseif (md5($params['passwordConfirm']) !== $newUser->getPassword()) {
                $this->view->addErrorMessage('Die Passw&ouml;rter stimmen nicht &uuml;berein');
            }
            if (!empty($this->view->errorMessages)) {
                $this->forward('User', 'register', array('newUser', $newUser));
            } else {
                $newUser->setConfirm_hash(md5(time() . $newUser->getName() . $newUser->getPassword()));
                $newUser->setDisable(TRUE);
                $this->userRepository->add($newUser);

                // Versende eine Email mit den Link zum Bestaetigen der Reegistrierung
                $content = "Klicken sie auf den unten angegebenen Link oder kopieren sie die URL in ihren Browser um die Registrierung zu bestaetigen:\r\n\r\n"
                        . "http://" . $_SERVER['HTTP_HOST'] . "/index.php?controller=user&action=confirmRegistration&hash=" . $newUser->getConfirmHash();
                $this->sendMail($newUser->getEmail(), 'Bestaetigen der Registrierung', $content);

                $this->view->assign('title', 'Registrierung gestartet');
                $this->view->render();
            }
        }
    }

    /**
     * Bestaetige die Registreirung ueber die Pruefung eines hash
     *
     * @return void
     */
    public function confirmRegistrationAction() {
        if(isset($this->params['hash'])) {
            $user = $this->userRepository->findOneByConfirm_hash($this->params['hash']);
            $user->setDisable(FALSE);
            $this->userRepository->update($user);
            $this->view->assign('title', 'Registrierung best&auml;tigt');
            $this->view->assign('registered', TRUE);
        } else {
            $this->view->assign('title', 'Registrierung kann nicht best&auml;tigt werden');
            $this->view->assign('registered', FALSE);
        }
        $this->view->render();
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