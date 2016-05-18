<?php
namespace Status\Service;

class HashedAssetLoadService
{
    /**
     * JS & CSS resources are hashed. This method gets the actual file name
     * Eg. styles.min.css might actually be styles-3578349430.min.css
     *
     * @param  string
     * @return string
     */
    public function loadResource($filename)
    {
        $file = basename($filename);
        $directory = "/dist/";
        $manifest = self::loadManifest($file);

        return $directory.$manifest[$file];
    }

    /**
     * Loads the manifest file which stores the actual filenames of hashed resources.
     * Regenerated when gulp compiles styles or scripts
     *
     * @param  string
     * @return array
     */
    protected function loadManifest($filename)
    {
        $file_type = pathinfo($filename, PATHINFO_EXTENSION);
        $manifest_file = __DIR__."/../../../dist/manifest.{$file_type}.json";
        $manifest = file_get_contents($manifest_file);

        return json_decode($manifest, true);
    }
}
