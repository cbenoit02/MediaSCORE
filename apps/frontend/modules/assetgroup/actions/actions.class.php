<?php

/**
 * assetgroup actions.
 *
 * @package    mediaSCORE
 * @subpackage assetgroup
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assetgroupActions extends sfActions {

    /**
     * list all asset groups or filter asset groups
     * 
     * @param sfWebRequest $request
     * @return json if ajax call 
     */
    public function executeIndex(sfWebRequest $request) {

        $this->AllStorageLocations = Doctrine_Query::create()->from('StorageLocation sl')->select('sl.id,sl.name')->fetchArray('name');
        $collectionId = $request->getParameter('c');
        $searchInpout = $request->getParameter('s');
        $status = $request->getParameter('status');
        $from = $request->getParameter('from');
        $to = $request->getParameter('to');
        $dateType = $request->getParameter('datetype');
        $AssetScore = $request->getParameter('searchScore');

        $score_end = $request->getParameter('score_end');
        $score_start = $request->getParameter('score_start');
        $scoreType = $request->getParameter('scoreType');

        // Get collections for a specific Asset Group
        if ($request->isXmlHttpRequest()) {
            $this->assets = Doctrine_Query::Create()
                    ->from('AssetGroup c')
                    ->select('c.*,cu.*,eu.*,ft.*')
                    ->innerJoin('c.Creator cu')
                    ->innerJoin('c.Editor eu')
                    ->innerJoin('c.FormatType ft')
                    ->where('c.parent_node_id  = ?', $collectionId);
            // apply the filters for assets group
            if ($searchInpout && trim($searchInpout) != '') {
                $this->assets = $this->assets->andWhere('name like "%' . $searchInpout . '%"');
            }
            if (trim($status) != '') {
                $this->assets = $this->assets->andWhere('status =?', $status);
            }
            if ($AssetScore != '') {
                $this->assets = $this->assets->andWhere('asset_score LIKE ?', "{$AssetScore}%");
            }

            if ($dateType != '') {
                if ($dateType == 0) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->assets = $this->assets->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(created_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->assets = $this->assets->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->assets = $this->assets->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                } else if ($dateType == 1) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->assets = $this->assets->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(updated_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->assets = $this->assets->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->assets = $this->assets->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                }
            }
            if ($scoreType == 'score') {

                if ($score_start != '' && $score_end != '') {
                    $this->assets = $this->assets->andWhere('(CAST(asset_score as DECIMAL(4,2))) >= ?', "{$score_start}");
                    $this->assets = $this->assets->andWhere('(CAST(asset_score as DECIMAL(4,2))) <= ?', "{$score_end}");
                }
            }
            // fetch the assets groups
            $this->assets = $this->assets->fetchArray();

            // get durations for assets groups respectively
            if (sizeof($this->assets) > 0) {
                foreach ($this->assets as $key => $value) {
                    $duration = new AssetGroup();
                    $duration = $duration->getDurationRealTime($value['format_id']);
                    $this->assets[$key]['duration'] = $duration;
                }
            }
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->assets));
        }
        // get the object of collection
        $collectionObject = $this->getRoute()->getObject();

        $this->forward404Unless($collectionObject);
        $this->collectionID = $collectionObject->getId();
        $this->forward404Unless($this->collectionID);
        if ($this->getUser()->getGuardUser()->getType() == 3) {
            $unit = Doctrine_Query::Create()
                    ->from('Unit u')
                    ->innerJoin('u.Collection c')
                    ->innerJoin('u.Personnel p')
                    ->where('person_id  = ?', $this->getUser()->getGuardUser()->getId())
                    ->andWhere('c.id  = ?', $this->collectionID)
                    ->fetchArray();

            $this->forward404Unless(count($unit) > 0);
        }
        // get collection for the assets group
        $collection = Doctrine_Core::getTable('Collection')
                ->find($this->collectionID);
        $this->forward404Unless($collection);
        // set the unit id of a collection
        $this->unitID = $collection->getParentNodeId();
        // get name of unit against collection
        $this->unitName = Doctrine_Core::getTable('Unit')
                ->find($this->unitID)
                ->getName();
        // get unit detail
        $this->unit = Doctrine_Core::getTable('Unit')
                ->find($this->unitID);
        $this->persons = Doctrine_Core::getTable('Evaluator')
                ->findAll();

        // get collection name
        $this->collectionName = $collection->getName();
        // get all the assets groups for given collection
        $this->asset_groups = Doctrine_Core::getTable('AssetGroup')
                ->findBy('parent_node_id', $this->collectionID);
    }

    /**
     * generate form for assets group. List down collections and units
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->units = Doctrine_Core::getTable('Unit')
                ->createQuery('a')
                ->execute();

        $this->collections = Doctrine_Core::getTable('Collection')
                ->createQuery('a')
                ->execute();

        $this->form = new AssetGroupForm(
                        null, array(
                    'creatorID' => $this->getUser()->getGuardUser()->getId(),
                    'collectionID' => $request->getParameter('c'))
        );
        $this->collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.id  = ?', $request->getParameter('c'))
                ->fetchOne();
    }

    /**
     * receive post request, process the form and insert the record.
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($this->getUser()->getGuardUser()->getType() != 3);
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $collectionId = sfToolkit::getArrayValueForPath($request->getParameter('asset_group'), 'parent_node_id');

        $this->form = new AssetGroupForm(null, array(
                    'creatorID' => $this->getUser()->getGuardUser()->getId(),
                    'collectionID' => $collectionId));
        $this->collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.id  = ?', $collectionId)
                ->fetchOne();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * generate asset group form with prefilled values. List all the collections and units
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
//        $this->collections = Doctrine_Core::getTable('Collection')->findAll();
        $this->unit = Doctrine_Core::getTable('Unit')->findAll();
        $this->assetCollection = Doctrine_Query::create()
                ->from('Collection c')
                ->where('c.id = ?', $asset_group->getParentNodeId())
                ->fetchOne();
        $this->collections = Doctrine_Query::create()
                ->from('Collection c')
                ->where('c.parent_node_id = ?', $this->assetCollection->getParentNodeId())
                ->execute();

        $this->form = new AssetGroupForm($asset_group, array(
                    'creatorID' => $this->getUser()->getGuardUser()->getId(),
                    'collectionID' => $request->getParameter('c'),
                    'action' => 'edit')
        );
        $this->form->setOption('collectionID', $request->getParameter('c'));
        $this->collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.id  = ?', $request->getParameter('c'))
                ->fetchOne();
    }

    /**
     * receive post request, process form values and update the record
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {

        $this->forward404Unless($this->getUser()->getGuardUser()->getType() != 3);
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
        $this->unit = Doctrine_Core::getTable('Unit')->findAll();
        $this->assetCollection = Doctrine_Query::create()
                ->from('Collection c')
                ->where('c.id = ?', $asset_group->getParentNodeId())
                ->fetchOne();
        $this->collections = Doctrine_Query::create()
                ->from('Collection c')
                ->where('c.parent_node_id = ?', $this->assetCollection->getParentNodeId())
                ->execute();


        $collectionId = sfToolkit::getArrayValueForPath($request->getParameter('asset_group'), 'parent_node_id');
        $this->form = new AssetGroupForm($asset_group, array(
                    'creatorID' => $this->getUser()->getGuardUser()->getId(),
                    'collectionID' => $collectionId,
                    'action' => 'edit'));
        $this->collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.id  = ?', $collectionId)
                ->fetchOne();
        $unitName = Doctrine_Query::Create()
                ->from('Unit u')
                ->select('u.*')
                ->where('u.id  = ?', $this->collection->getParentNodeId())
                ->fetchOne();
        $validateForm = $this->processEditForm($request, $this->form);
        if ($validateForm) {
            $this->redirect('/' . $unitName->getNameSlug() . '/' . $this->collection->getNameSlug() . '/');
        }
        else
            $this->setTemplate('edit');
    }

    /**
     * delete asset group
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
//        $request->checkCSRFProtection();

        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));

        $collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.id  = ?', $asset_group->getParentNodeId())
                ->fetchOne();
        $unit = Doctrine_Query::Create()
                ->from('Unit u')
                ->select('u.*')
                ->where('u.id  = ?', $collection->getParentNodeId())
                ->fetchOne();
        $asset_group->delete();
        $this->redirect('/' . $unit->getNameSlug() . '/' . $collection->getNameSlug() . '/');
    }

    /**
     * process and validate the form.
     * 
     * @param sfWebRequest $request
     * @param sfForm $form 
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $collectionId = sfToolkit::getArrayValueForPath($form->getName(), 'parent_node_id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $asset_group = $form->save();

            $this->redirect('assetgroup/edit?id=' . $asset_group->getId() . '&c=' . $form->getOption('collectionID'));
        }
    }

    /**
     * process and validate form when record is edited
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @return boolean 
     */
    protected function processEditForm(sfWebRequest $request, sfForm $form) {
        $collectionId = sfToolkit::getArrayValueForPath($form->getName(), 'parent_node_id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $asset_group = $form->save();
            $PostParams = $request->getPostParameters();

            $AssetInformatoin = Doctrine_Query::Create()
                    ->from('AssetGroup a')
                    ->select('a.*,ft.*')
                    ->leftJoin('a.FormatType ft WITH ft.id=a.format_id')
                    ->addWhere("ft.id = '" . $PostParams['asset_group']['format_id'] . "'")
                    ->fetchArray();

            $characteristicsValue = Doctrine_Query::Create()
                    ->from('CharacteristicsValues cv')
                    ->select('cv.*,cc.*,cf.*')
                    ->leftJoin('cv.CharacteristicsConstraints cc')
                    ->leftJoin('cv.CharacteristicsFormat cf')
                    ->addWhere("cv.format_id = '" . $AssetInformatoin[0]['FormatType']['type'] . "'")
                    ->fetchArray();

            #Move copies to the end to check the total score if score is greater then 90 and less then 12 , copies score wont apply 
            $copiesValue = NULL;
            $copieExist = FALSE;
            foreach ($characteristicsValue as $key => $SingleValue) {
                if ($SingleValue['c_name'] == 'copies') {
                    $copiesValue = $SingleValue;
                    $copieExist = TRUE;
                    unset($characteristicsValue[$key]);
                }
            }
            $characteristicsValue[] = $copiesValue;

            #Loading Socre Calculater Library 
            $ScoreCalculator = new scoreCalculator();
            $score = $ScoreCalculator->callFormatCalculator($AssetInformatoin, $characteristicsValue);

            #If Score is Greater Then 90 And Less Then 12 , Deduct Copies Score From Total
            if ($copieExist && isset($score['score']) && ($score['score'] >= 90 || $score['score'] <= 12)) {
                if ($AssetInformatoin[0]['FormatType']['copies'] == 1) {
                    $scoreTotal = (float) $score['score'] - (float) $copiesValue['c_score'];
                    if ($scoreTotal > 100) {
                        $scoreTotal = 100;
                    }
                    $score['scoreRounded'] = round((float) $scoreTotal / 20, 2);
                    $score['score'] = (float) $scoreTotal;
                }
            }
            if ($score != FALSE) {
                $update = Doctrine_Query::create()
                        ->update('FormatType ')
                        ->set('asset_score', '?', $score['scoreRounded'])
                        ->where('id = ?', $AssetInformatoin[0]['FormatType']['id'])
                        ->execute();
                echo 'Done';
            } else {
                echo 'calculator not found for this format type';
            }

            return true;
        }
        return false;
    }

    public function executeGetScore(sfWebRequest $request) {
        $score = 0;
        $AssetInformatoin = Doctrine_Query::Create()
                ->from('AssetGroup a')
                ->select('a.*,ft.*')
                ->leftJoin('a.FormatType ft WITH ft.id=a.format_id')
                ->addWhere('a.id =?', $request->getParameter('id'))
                ->fetchArray();
        $characteristicsValue = Doctrine_Query::Create()
                ->from('CharacteristicsValues cv')
                ->select('cv.*,cc.*,cf.*')
                ->leftJoin('cv.CharacteristicsConstraints cc')
                ->leftJoin('cv.CharacteristicsFormat cf')
                ->addWhere('cv.format_id = ?', $AssetInformatoin[0]['FormatType']['type'])
                ->fetchArray();
        $ScoreCalculator = new scoreCalculator();

        $score = $ScoreCalculator->callFormatCalculator($AssetInformatoin, $characteristicsValue);
        exit;
    }

}

