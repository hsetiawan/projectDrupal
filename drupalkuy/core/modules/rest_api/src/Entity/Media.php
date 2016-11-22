<?php

namespace Drupal\rest_api\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\rest_api\MediaInterface;

class Media extends ConfigEntityBase implements MediaInterface { //extends ContentEntityBase implements NodeInterface


private $upload;
private $filename;
private $filemime;
private $description;




    /**
     * Get the value of Upload
     *
     * @return mixed
     */
    public function getUpload()
    {
        return $this->upload;
    }

    /**
     * Set the value of Upload
     *
     * @param mixed upload
     *
     * @return self
     */
    public function setUpload($upload)
    {
        $this->upload = $upload;

        return $this;
    }

    /**
     * Get the value of Filename
     *
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of Filename
     *
     * @param mixed filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of Filemime
     *
     * @return mixed
     */
    public function getFilemime()
    {
        return $this->filemime;
    }

    /**
     * Set the value of Filemime
     *
     * @param mixed filemime
     *
     * @return self
     */
    public function setFilemime($filemime)
    {
        $this->filemime = $filemime;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

}

 ?>
