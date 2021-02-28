<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetCommissionGroupsDefinition
 *
 * @package CLSystems\Awin\Request
 */
class GetCommissionGroupsDefinition extends AbstractRequestDefinition
{
    public function getMethod() : string
    {
        return 'GET';
    }

    public function getBaseUrl() : string
    {
        return sprintf(
            '/publishers/%s/commissiongroups?advertiserId=%s',
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
