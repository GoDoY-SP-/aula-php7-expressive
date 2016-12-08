<?php
namespace CodeEmailMKT\Domain\Storage;

interface DefaultStorageInterface
{
    public function setNamespace($name);

    public function isEmpty();

    public function read();

    public function write($contents);

    public function clear();
}