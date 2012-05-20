<?php
// auto-generated by sfViewConfigHandler
// date: 2012/05/20 20:26:05
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'newSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'editSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'newSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('smoothness/jquery-ui-1.8.20.custom.css', '', array ());
  $response->addStylesheet('wireframes/style.css', '', array ());
  $response->addJavascript('jquery-1.7.2.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.8.20.smoothness.min.js', '', array ());
  $response->addJavascript('jquery_layout.js', '', array ());
  $response->addJavascript('jquery_collection_form', '', array ());
}
else if ($templateName.$this->viewName == 'editSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('smoothness/jquery-ui-1.8.20.custom.css', '', array ());
  $response->addStylesheet('wireframes/style.css', '', array ());
  $response->addJavascript('jquery-1.7.2.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.8.20.smoothness.min.js', '', array ());
  $response->addJavascript('jquery_layout.js', '', array ());
  $response->addJavascript('jquery_collection_form', '', array ());
}
else
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('smoothness/jquery-ui-1.8.20.custom.css', '', array ());
  $response->addStylesheet('wireframes/style.css', '', array ());
  $response->addJavascript('jquery-1.7.2.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.8.20.smoothness.min.js', '', array ());
  $response->addJavascript('jquery_layout.js', '', array ());
}

