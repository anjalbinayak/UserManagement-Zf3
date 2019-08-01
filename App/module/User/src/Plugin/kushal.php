<?php

class Abc
{
	private function setListenersForErrors($sharedEventManager)
{
$sharedEventManager->attach('*', MvcEvent::EVENT_DISPATCH, array($this, 'onDispatchError'), -100);
        $sharedEventManager->attach('*', MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), -100);
        $sharedEventManager->attach('*', MvcEvent::EVENT_RENDER_ERROR, array(
            $this,
            'onDispatchError'
        , - 100);
}
 private function setErrorTemplate($viewModel)
{
$viewModel->setTemplate('layout/error-layout');
}
(4:05:58 PM) public function init(ModuleManager $manager) {
$eventManager = $manager->getEventManager();
$sharedEventManager = $eventManager->getSharedManager();

$sharedEventManager->attach(BaseController::class, MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);

$this->setListenersForErrors($sharedEventManager);

$sharedEventManager->attach(AbstractRestfulController::class, MvcEvent::EVENT_DISPATCH, [$this, 'onDispatchApi'], 100);

$this->role = new Role(self::ROLE_NAME);
}

}