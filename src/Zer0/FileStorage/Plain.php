<?php

namespace Zer0\FileStorage;

/**
 * Class Plain
 * @package Zer0\FileStorage
 */
final class Plain extends Base
{
    /**
     * @param string $path
     * @param string $container
     * @param string $dest
     * @param array $options = []
     * @return void
     */
    public function putFile(string $path, string $container, string $dest, array $options = []): void
    {
        $container = $this->resolveContainer($container);
        $destPath = $this->config->path . '/' . basename($container) . '/' . $dest;
        $dir = dirname($destPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0770, true);
        }
        copy($path, $destPath);
    }

    /**
     * @param string $container
     * @param string $path
     * @return string
     */
    public function getPath(string $container, string $path): string
    {
        return $this->config->path . '/' . basename($container) . '/' . $path;
    }

    /**
     * @param string $container
     * @param string $path
     * @return bool
     */
    public function delete(string $container, string $path): void
    {
        $container = $this->resolveContainer($container);
        $fullPath = $this->config->path . '/' . basename($container) . '/' . $path;
        unlink($fullPath);
    }
}
