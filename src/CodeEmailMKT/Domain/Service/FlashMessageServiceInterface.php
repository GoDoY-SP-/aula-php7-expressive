<?php

namespace CodeEmailMKT\Domain\Service;

interface FlashMessageServiceInterface
{
    /**
     * Default messages namespace
     */
    const NAMESPACE_DEFAULT = 'default';
    /**
     * Success messages namespace
     */
    const NAMESPACE_SUCCESS = 'success';
    /**
     * Warning messages namespace
     */
    const NAMESPACE_WARNING = 'warning';
    /**
     * Error messages namespace
     */
    const NAMESPACE_ERROR = 'error';
    /**
     * Info messages namespace
     */
    const NAMESPACE_INFO = 'info';

    /**
     * Setar Namespace
     * @param $name
     * @return mixed
     */
    public function setNamespace($name);

    /**
     * Setar FlashMessage
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setMessage($key, $value);

    /**
     * Obter FlashMessage
     * @param $key
     * @return mixed
     */
    public function getMessage($key);
}