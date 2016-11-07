<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Http\Responses;
use Neomerx\JsonApi\Http\Headers\MediaType;

class Response extends Responses
{
    function __construct($encoder){
        $this->encoder = $encoder;
    }

    /**
     * Create HTTP response.
     *
     * @param string|null $content
     * @param int         $statusCode
     * @param array       $headers
     *
     * @return mixed
     */
    protected function createResponse($content, $statusCode, array $headers)
    {
        return [$content, $statusCode, $headers];
        // var_dump(func_get_args());
    }

    /**
     * @return EncoderInterface
     */
    protected function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * @return string|null
     */
    protected function getUrlPrefix()
    {
        //
    }

    /**
     * @return EncodingParametersInterface|null
     */
    protected function getEncodingParameters()
    {
        //
    }

    /**
     * @return ContainerInterface
     */
    protected function getSchemaContainer()
    {
        //
    }

    /**
     * @return SupportedExtensionsInterface|null
     */
    protected function getSupportedExtensions()
    {
        //
    }

    /**
     * @return MediaTypeInterface
     */
    protected function getMediaType()
    {
        return new MediaType('application', 'vnd.api+json');
    }
}
