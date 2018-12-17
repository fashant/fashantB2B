<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 24/10/2018
 * Time: 10:28
 */

class Comment
{
    public $review_id;
    public $comment;
    public $ukey;
    public $date;


    /**
     * @return mixed
     */
    public function getReviewId()
    {
        return $this->review_id;
    }

    /**
     * @param mixed $review_id
     */
    public function setReviewId($review_id)
    {
        $this->review_id = $review_id;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getUkey()
    {
        return $this->ukey;
    }

    /**
     * @param mixed $ukey
     */
    public function setUkey($ukey)
    {
        $this->ukey = $ukey;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    
}