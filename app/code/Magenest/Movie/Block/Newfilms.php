<?php
namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
class Newfilms extends Template
{
    private $_filmCollection;
    private $_actorCollection;
    private $_directorCollection;

    public function __construct(
        Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\MagenestMovie\Collection $filmCollection,
        \Magenest\Movie\Model\ResourceModel\MagenestActor\Collection $actorCollection,
        \Magenest\Movie\Model\ResourceModel\MagenestDirector\Collection $directorCollection,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_filmCollection = $filmCollection;
        $this->_actorCollection = $actorCollection;
        $this->_directorCollection = $directorCollection;
    }

    public function getActor($movieId)
    {
        $listActorName='';
        $actorName = $this->_actorCollection->getJoinData();
        foreach ($actorName as $key){
            if($key->getData('movie_id')==$movieId) {
                $listActorName .= $key->getData('actor_name').' ; ';
            }
        }
        return $listActorName;
    }

    public function getFilms(){
        $filmcollection = $this->_filmCollection->getJoin();
        return $filmcollection;
    }
}
