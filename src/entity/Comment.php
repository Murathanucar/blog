<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 07.08.2017
 * Time: 15:49
 */

namespace src\entity;


class Comment
{


    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $text;
    /**
     * @var date
     */
    protected $date;
    /**
     * @var integer
     */
    protected $article_id;
    /**
     * @var integer
     */
    protected $member_id;

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * @param int $article_id
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;
    }

    /**
     * @return int
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * @param int $member_id
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }


}