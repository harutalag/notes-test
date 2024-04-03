<?php
namespace frontend\models;

use common\models\ClientHasClub;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class ClientForm extends \common\models\Client
{
    /**
     * @var array list of Clubs used by the form
     */

    public $clubs = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),array(
            ['clubs', 'required'],
            ['clubs', 'safe']
        ));
    }
    /**
     * @var array|null list of old Clubs (as loaded from DB)
     * This is `null` if the record [[isNewRecord|is new]].
     */

    private $_oldClubs;


    /**
     * Overrides parent method.
     * Saves the current record and updates related BookAuthor records
     * @inheritdoc
     */

    public function save($runValidation = true, $attributeNames = null)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if (!parent::save($runValidation, $attributeNames)) {
                return false;
            }

            $this->addNewClubs();
            $this->deleteOldClubs();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return true;
    }

    /**
     *
     * @throws Exception update failed
     */
    protected function addNewClubs()
    {
        // Add new records
        foreach ($this->clubs as $clubID) {
            $clientHasClub = new ClientHasClub();
            $clientHasClub->client_id = $this->id;
            $clientHasClub->club_id = $clubID;

            if (!$clientHasClub->save()) {
                throw new Exception('Failed to save related records.');
            }
        }
    }

    /**
     *
     * @throws Exception update failed
     */
    protected function deleteOldClubs()
    {
        foreach ($this->clientHasClubs as $clientHasClub) {
            if (!in_array($clientHasClub->club_id, $this->clubs) &&
                $clientHasClub->delete() === false) {
                throw new Exception('Failed to save related records.');
            }
        }
    }

    public function afterFind()
    {
        foreach ($this->clientHasClubs as $clientHasClub) {
            $this->clubs[] = $clientHasClub->club_id;
        }

        $this->_oldClubs = $this->clubs;

        parent::afterFind();
    }
}