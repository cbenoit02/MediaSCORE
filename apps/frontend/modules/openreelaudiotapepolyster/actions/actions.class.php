<?php

/**
 * openreelaudiotapepolyster actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapepolyster
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapepolysterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->open_reel_audiotape_polysters = Doctrine_Core::getTable('OpenReelAudiotapePolyster')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->open_reel_audiotape_polyster);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OpenReelAudiotapePolysterForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OpenReelAudiotapePolysterForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpenReelAudiotapePolysterForm($open_reel_audiotape_polyster);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpenReelAudiotapePolysterForm($open_reel_audiotape_polyster);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));
    $open_reel_audiotape_polyster->delete();

    $this->redirect('openreelaudiotapepolyster/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $open_reel_audiotape_polyster = $form->save();

      $this->redirect('openreelaudiotapepolyster/edit?id='.$open_reel_audiotape_polyster->getId());
    }
  }
}