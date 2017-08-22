<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 07.08.2017
 * Time: 15:07
 */

namespace src\entity;

class Article extends Entity
{


    /**
     * @var integer
     */
    protected $id;
    /**
     * @var  string
     */
    protected $description;
    /**
     * @var string
     */
    protected $content;
    /**
     * @var integer
     */
    protected $category_id;
    /**
     * @var integer
     */
    protected $user_id;
    /**
     * @var integer
     */
    protected $file_id;
    /**
     * @var date
     */
    protected $created_at;
    /**
     * @var integer
     */
    protected $status;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * @param int $file_id
     */
    public function setFileId($file_id)
    {
        $this->file_id = $file_id;
    }

    /**
     * @return date
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param date $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}