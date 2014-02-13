<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Component\Content;

use DateTime;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;

/**
 * Structure generated from Structure Manager to map a template.
 * This class is a blueprint of Subclasses generated by StructureManager. This sub classes will be cached in Symfony Cache
 */
abstract class Structure implements StructureInterface
{
    /**
     * unique key of template
     * @var string
     */
    private $key;

    /**
     * template to render content
     * @var string
     */
    private $view;

    /**
     * controller to render content
     * @var string
     */
    private $controller;

    /**
     * time to cache content
     * @var int
     */
    private $cacheLifeTime;

    /**
     * array of properties
     * @var array
     */
    private $properties = array();

    /**
     * has structure sub structures
     * @var bool
     */
    private $hasChildren = false;

    /**
     * children of node
     * @var StructureInterface[]
     */
    private $children = null;

    /**
     * uuid of node in CR
     * @var string
     */
    private $uuid;

    /**
     * user id of creator
     * @var int
     */
    private $creator;

    /**
     * user id of changer
     * @var int
     */
    private $changer;

    /**
     * datetime of creation
     * @var DateTime
     */
    private $created;

    /**
     * datetime of last changed
     * @var DateTime
     */
    private $changed;

    /**
     * state of node
     * @var int
     */
    private $nodeState;

    /**
     * global state of node (with inheritance)
     * @var int
     */
    private $globalState;

    /**
     * @param $key string
     * @param $view string
     * @param $controller string
     * @param int $cacheLifeTime
     * @return \Sulu\Component\Content\Structure
     */
    public function __construct($key, $view, $controller, $cacheLifeTime = 604800)
    {
        $this->key = $key;
        $this->view = $view;
        $this->controller = $controller;
        $this->cacheLifeTime = $cacheLifeTime;

        // default state is test
        $this->nodeState = StructureInterface::STATE_TEST;
    }

    /**
     * adds a property to structure
     * @param PropertyInterface $property
     */
    protected function add(PropertyInterface $property)
    {
        $this->properties[$property->getName()] = $property;
    }

    /**
     * key of template definition
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * twig template of template definition
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * controller which renders the template definition
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * cacheLifeTime of template definition
     * @return int
     */
    public function getCacheLifeTime()
    {
        return $this->cacheLifeTime;
    }

    /**
     * returns uuid of node
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * sets uuid of node
     * @param $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * returns id of creator
     * @return int
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * sets user id of creator
     * @param $userId int id of creator
     */
    public function setCreator($userId)
    {
        $this->creator = $userId;
    }

    /**
     * returns user id of changer
     * @return int
     */
    public function getChanger()
    {
        return $this->changer;
    }

    /**
     * sets user id of changer
     * @param $userId int id of changer
     */
    public function setChanger($userId)
    {
        $this->changer = $userId;
    }

    /**
     * return created datetime
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * sets created datetime
     * @param DateTime $created
     * @return \DateTime
     */
    public function setCreated(DateTime $created)
    {
        return $this->created = $created;
    }

    /**
     * returns changed DateTime
     * @return DateTime
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * sets changed datetime
     * @param \DateTime $changed
     */
    public function setChanged(DateTime $changed)
    {
        $this->changed = $changed;
    }

    /**
     * returns a property instance with given name
     * @param $name string name of property
     * @return PropertyInterface
     * @throws NoSuchPropertyException
     */
    public function getProperty($name)
    {
        if ($this->hasProperty($name)) {
            return $this->properties[$name];
        } else {
            throw new NoSuchPropertyException();
        }
    }

    /**
     * checks if a property exists
     * @param string $name
     * @return boolean
     */
    public function hasProperty($name)
    {
        return isset($this->properties[$name]);
    }

    /**
     * @param boolean $hasChildren
     */
    public function setHasChildren($hasChildren)
    {
        $this->hasChildren = $hasChildren;
    }

    /**
     * @return boolean
     */
    public function getHasChildren()
    {
        return $this->hasChildren;
    }

    /**
     * @param StructureInterface[] $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return null|StructureInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param int $state
     * @return int
     */
    public function setNodeState($state)
    {
        $this->nodeState = $state;
    }

    /**
     * returns state of node
     * @return int
     */
    public function getNodeState()
    {
        return $this->nodeState;
    }

    /**
     * returns true if state of site is "published"
     * @return boolean
     */
    public function getPublished()
    {
        return ($this->nodeState === 2);
    }

    /**
     * @param int $globalState
     */
    public function setGlobalState($globalState)
    {
        $this->globalState = $globalState;
    }

    /**
     * returns global state of node (with inheritance)
     * @return int
     */
    public function getGlobalState()
    {
        return $this->globalState;
    }

    /**
     * returns an array of properties
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * magic getter
     * @param $property string name of property
     * @return mixed
     * @throws NoSuchPropertyException
     */
    public function __get($property)
    {
        if (method_exists($this, 'get' . ucfirst($property))) {
            return $this->{'get' . ucfirst($property)}();
        } else {
            return $this->getProperty($property)->getValue();
        }
    }

    /**
     * magic setter
     * @param $property string name of property
     * @param $value mixed value
     * @return mixed
     * @throws NoSuchPropertyException
     */
    public function __set($property, $value)
    {
        if (isset($this->properties[$property])) {
            return $this->getProperty($property)->setValue($value);
        } else {
            throw new NoSuchPropertyException();
        }
    }

    /**
     * magic isset
     * @param $property
     * @return bool
     */
    public function __isset($property)
    {
        if (isset($this->properties[$property])) {
            $value = $this->getProperty($property)->getValue();

            return $value !== null;
        } else {
            return isset($this->$property);
        }
    }

    /**
     * returns an array of property value pairs
     * @return array
     */
    public function toArray()
    {
        return $this->jsonSerialize();
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $result = array(
            'id' => $this->uuid,
            'nodeState' => $this->getNodeState(),
            'globalState' => $this->getNodeState(),
            'published' => $this->getPublished(),
            'hasSub' => $this->hasChildren,
            'creator' => $this->creator,
            'changer' => $this->changer,
            'created' => $this->created,
            'changed' => $this->changed
        );

        /** @var PropertyInterface $property */
        foreach ($this->getProperties() as $property) {
            $result[$property->getName()] = $property->getValue();
        }

        return $result;
    }

}
