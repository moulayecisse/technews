<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 05/07/2018
 * Time: 11:15
 */

namespace App\Console\Cache\Warmer;


use App\Factory\ArticleFactory;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmer;

class YamlCacheWarmer extends CacheWarmer
{
    /**
     * @var KernelInterface $kernel
     */
    private $kernel;

    /**
     * YamlCacheWarmer constructor.
     * @param $kernel
     */
    public function __construct( KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    /**
     * Checks whether this warmer is optional or not.
     *
     * Optional warmers can be ignored on certain conditions.
     *
     * A warmer should return true if the cache can be
     * generated incrementally and on-demand.
     *
     * @return bool true if the warmer is optional, false otherwise
     */
    public function isOptional()
    {
        return false;
    }

    /**
     * Warms up the cache.
     *
     * @param string $cacheDir The cache directory
     */
    public function warmUp($cacheDir)
    {
        try
        {
            $articles = Yaml::parseFile($this->kernel->getDataDir() . '/articles.yaml')['data'];
            $this->writeCacheFile($cacheDir . '/yaml-article.php', serialize($articles));
        } catch (ParseException $parseException)
        {
            printf( 'Unable to parse the YAML string: %s', $parseException->getMessage() );
        }
    }
}