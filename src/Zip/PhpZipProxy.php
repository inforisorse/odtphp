<?php
declare(strict_types=1);

namespace Inforisorse\OdtPhp\Zip;

use Inforisorse\OdtPhp\Zip\ZipInterface;
use Inforisorse\OdtPhp\Exceptions\PhpZipProxyException;
use ZipArchive;
class PhpZipProxy implements ZipInterface
{
    protected $zipArchive;
    protected $filename;

    /**
     * Class constructor
     *
     * @throws PhpZipProxyException
     */
    public function __construct()
    {
        if (! class_exists('ZipArchive')) {
            throw new PhpZipProxyException('Zip extension not loaded - check your php settings, PHP5.2 minimum with zip extension is required for using PhpZipProxy');
        }
        $this->zipArchive = new ZipArchive;
    }

    /**
     * Open a Zip archive
     *
     * @param string $filename the name of the archive to open
     * @return true if openning has succeeded
     */
    public function open($filename)
    {
        $this->filename = $filename;
        return $this->zipArchive->open($filename, ZIPARCHIVE::CREATE);
    }

    /**
     * Retrieve the content of a file within the archive from its name
     *
     * @param string $name the name of the file to extract
     * @return the content of the file in a string
     */
    public function getFromName($name)
    {
        return $this->zipArchive->getFromName($name);
    }

    /**
     * Add a file within the archive from a string
     *
     * @param string $localname the local path to the file in the archive
     * @param string $contents the content of the file
     * @return true if the file has been successful added
     */
    public function addFromString($localname, $contents)
    {
        if (file_exists($this->filename) && !is_writable($this->filename)) {
            return false;
        }
        return $this->zipArchive->addFromString($localname, $contents);
    }

    /**
     * Add a file within the archive from a file
     *
     * @param string $filename the path to the file we want to add
     * @param string $localname the local path to the file in the archive
     * @return true if the file has been successful added
     */
    public function addFile($filename, $localname = null)
    {
        if ((file_exists($this->filename) && !is_writable($this->filename))
            || !file_exists($filename)) {
            return false;
        }
        return $this->zipArchive->addFile($filename, $localname);
    }

    /**
     * Close the Zip archive
     * @return true
     */
    public function close()
    {
        return $this->zipArchive->close();
    }
}
