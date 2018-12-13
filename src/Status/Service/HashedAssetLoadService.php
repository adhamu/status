<?php
namespace Status\Service;

class HashedAssetLoadService
{
    /**
     * JS & CSS resources are hashed. This method gets the actual file name
     * Eg. styles.min.css might actually be styles-3578349430.min.css
     */
    public function loadResource(string $filename): string
    {
        $file = basename($filename);
        $directory = 'dist/';
        $manifest = $this->loadManifest();

        return $directory . $manifest[$file];
    }

    /**
     * Loads the manifest file which stores the actual filenames of hashed resources.
     * Regenerated when gulp compiles styles or scripts
     */
    protected function loadManifest(): array
    {
        $manifest = file_get_contents(__DIR__ . '/../../../dist/manifest.json');

        return json_decode($manifest, true);
    }
}
