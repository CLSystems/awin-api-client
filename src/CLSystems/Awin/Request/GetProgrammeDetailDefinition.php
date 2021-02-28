<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetProgrammeDetailDefinition
 *
 * @package CLSystems\Awin\Request
 */
class GetProgrammeDetailDefinition extends AbstractRequestDefinition
{
    public function getMethod() : string
    {
        return 'GET';
    }

    public function getBaseUrl() : string
    {
        return sprintf(
            '/publishers/%s/programmedetails?advertiserId=%s',
            $this->getOptions()['publisherId'],
            $this->getOptions()['advertiserId']
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'publisherId',
            'advertiserId'
        ]);
        $resolver->setRequired(['publisherId', 'advertiserId']);
    }
}
