<?php

/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 14:40
 */
class addNewBrand
{
    public $id;
    public $name;
    public $about;
    public $logo;
    public $policies;
    public $gallery;
    public $store_location;
    public $address;
    public $contact_phone;
    public $contact_email;
    public $price_category;
    public $city;
    public $shopping_center;
    public $ukey;
    public $categories;
    public $primary_category;
    public $taggings;
    public $open_mon;
    public $open_tues;
    public $open_wed;
    public $open_thurs;
    public $open_fri;
    public $open_sat;
    public $open_sun;
    public $close_mon;
    public $close_tues;
    public $close_wed;
    public $close_thurs;
    public $close_fri;
    public $close_sat;
    public $close_sun;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getPolicies()
    {
        return $this->policies;
    }

    /**
     * @param mixed $policies
     */
    public function setPolicies($policies)
    {
        $this->policies = $policies;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return mixed
     */
    public function getStoreLocation()
    {
        return $this->store_location;
    }

    /**
     * @param mixed $store_location
     */
    public function setStoreLocation($store_location)
    {
        $this->store_location = $store_location;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->contact_phone;
    }

    /**
     * @param mixed $contact_phone
     */
    public function setContactPhone($contact_phone)
    {
        $this->contact_phone = $contact_phone;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * @param mixed $contact_email
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    /**
     * @return mixed
     */
    public function getPriceCategory()
    {
        return $this->price_category;
    }

    /**
     * @param mixed $price_category
     */
    public function setPriceCategory($price_category)
    {
        $this->price_category = $price_category;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getShoppingCenter()
    {
        return $this->shopping_center;
    }

    /**
     * @param mixed $shopping_center
     */
    public function setShoppingCenter($shopping_center)
    {
        $this->shopping_center = $shopping_center;
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
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getPrimaryCategory()
    {
        return $this->primary_category;
    }

    /**
     * @param mixed $primary_category
     */
    public function setPrimaryCategory($primary_category)
    {
        $this->primary_category = $primary_category;
    }

    /**
     * @return mixed
     */
    public function getTaggings()
    {
        return $this->taggings;
    }

    /**
     * @param mixed $taggings
     */
    public function setTaggings($taggings)
    {
        $this->taggings = $taggings;
    }


    /**
     * @return mixed
     */
    public function getOpenMon()
    {
        return $this->open_mon;
    }

    /**
     * @param mixed $open_mon
     */
    public function setOpenMon($open_mon)
    {
        $this->open_mon = $open_mon;
    }

    /**
     * @return mixed
     */
    public function getOpenTues()
    {
        return $this->open_tues;
    }

    /**
     * @param mixed $open_tues
     */
    public function setOpenTues($open_tues)
    {
        $this->open_tues = $open_tues;
    }

    /**
     * @return mixed
     */
    public function getOpenWed()
    {
        return $this->open_wed;
    }

    /**
     * @param mixed $open_wed
     */
    public function setOpenWed($open_wed)
    {
        $this->open_wed = $open_wed;
    }

    /**
     * @return mixed
     */
    public function getOpenThurs()
    {
        return $this->open_thurs;
    }

    /**
     * @param mixed $open_thurs
     */
    public function setOpenThurs($open_thurs)
    {
        $this->open_thurs = $open_thurs;
    }

    /**
     * @return mixed
     */
    public function getOpenFri()
    {
        return $this->open_fri;
    }

    /**
     * @param mixed $open_fri
     */
    public function setOpenFri($open_fri)
    {
        $this->open_fri = $open_fri;
    }

    /**
     * @return mixed
     */
    public function getOpenSat()
    {
        return $this->open_sat;
    }

    /**
     * @param mixed $open_sat
     */
    public function setOpenSat($open_sat)
    {
        $this->open_sat = $open_sat;
    }

    /**
     * @return mixed
     */
    public function getOpenSun()
    {
        return $this->open_sun;
    }

    /**
     * @param mixed $open_sun
     */
    public function setOpenSun($open_sun)
    {
        $this->open_sun = $open_sun;
    }

    /**
     * @return mixed
     */
    public function getCloseMon()
    {
        return $this->close_mon;
    }

    /**
     * @param mixed $close_mon
     */
    public function setCloseMon($close_mon)
    {
        $this->close_mon = $close_mon;
    }

    /**
     * @return mixed
     */
    public function getCloseTues()
    {
        return $this->close_tues;
    }

    /**
     * @param mixed $close_tues
     */
    public function setCloseTues($close_tues)
    {
        $this->close_tues = $close_tues;
    }

    /**
     * @return mixed
     */
    public function getCloseWed()
    {
        return $this->close_wed;
    }

    /**
     * @param mixed $close_wed
     */
    public function setCloseWed($close_wed)
    {
        $this->close_wed = $close_wed;
    }

    /**
     * @return mixed
     */
    public function getCloseThurs()
    {
        return $this->close_thurs;
    }

    /**
     * @param mixed $close_thurs
     */
    public function setCloseThurs($close_thurs)
    {
        $this->close_thurs = $close_thurs;
    }

    /**
     * @return mixed
     */
    public function getCloseFri()
    {
        return $this->close_fri;
    }

    /**
     * @param mixed $close_fri
     */
    public function setCloseFri($close_fri)
    {
        $this->close_fri = $close_fri;
    }

    /**
     * @return mixed
     */
    public function getCloseSat()
    {
        return $this->close_sat;
    }

    /**
     * @param mixed $close_sat
     */
    public function setCloseSat($close_sat)
    {
        $this->close_sat = $close_sat;
    }

    /**
     * @return mixed
     */
    public function getCloseSun()
    {
        return $this->close_sun;
    }

    /**
     * @param mixed $close_sun
     */
    public function setCloseSun($close_sun)
    {
        $this->close_sun = $close_sun;
    }



}