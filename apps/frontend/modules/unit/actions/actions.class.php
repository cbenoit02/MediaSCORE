<?php

/**
 * unit actions.
 *
 * @package    mediaSCORE
 * @subpackage unit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class unitActions extends sfActions
{
	public function executeGetUnitForAssetGroup(sfWebRequest $request) {

		if($request->isXmlHttpRequest()) {
			// assetgroup.parent_node_id -> collection
			// collection.parent_node_id -> unit

			$assetGroupID = $request->getParameter('id');

			// Too many exceptions thrown - taking an overly complex approach
			// (getFirst() and fetchOne() throw exceptions)
			// Needs to be optimized
			//$map = array('AssetGroup','Collection','Unit');

			$assetGroups = Doctrine_Core::getTable('AssetGroup')
				->createQuery('a')
				->where('id =?',$assetGroupID)
				->execute()
				->toArray();
			$assetGroup = array_pop($assetGroups);

			$collections = Doctrine_Core::getTable('Collection')
				->createQuery('c')
				->where('id =?',$assetGroup['parent_node_id'])
				->execute()
				->toArray();
			$collection = array_pop($collections);

			$units = Doctrine_Core::getTable('Unit')
				->createQuery('u')
				->where('id =?',$collection['parent_node_id'])
				->execute()
				->toArray();

			$this->getResponse()->setHttpHeader('Content-type','application/json');
			$this->setLayout('json');
			$this->setTemplate('index');
			echo json_encode(array_pop($units));
		}
	}

	public function executeIndex(sfWebRequest $request) {

		$this->units = Doctrine_Core::getTable('Unit')
			->createQuery('a')
			->execute();
		
		// To be moved into a separate Action or Controller
		if($request->isXmlHttpRequest()) {
			$this->getResponse()->setHttpHeader('Content-type','application/json');
			$this->setLayout('json');
			echo json_encode($this->units->toArray());		
		}
	}

  public function executeShow(sfWebRequest $request)
  {
    $this->unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->unit);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UnitForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UnitForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
	  $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));

    $this->form = new UnitForm($unit);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
    $this->form = new UnitForm($unit);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
    $unit->delete();

    $this->redirect('unit/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

      $unit = $form->save();

      $this->redirect('unit/index');
    }
  }
}