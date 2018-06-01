<?php

declare(strict_types = 1);

namespace BeHappy\SyliusAgeVerificationPlugin\Form\Extension;

use BeHappy\SyliusAgeVerificationPlugin\Validator\Constraints\AgeVerification;
use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CustomerProfileTypeExtension
 *
 * @package BeHappy\SyliusAgeVerificationPlugin\Form\Extension
 */
class CustomerRegistrationTypeExtension extends AbstractTypeExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    
    /**
     * CustomerProfileTypeExtension constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthday', BirthdayType::class, [
                'label' => 'sylius.form.customer.birthday',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'groups' => ['sylius']
                    ]),
                    new AgeVerification([
                        'age' => $this->container->getParameter('be_happy.age_verification.minimal_age'),
                        'groups' => ['sylius']
                    ])
                ]
            ]);
    }
    
    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return CustomerRegistrationType::class;
    }
}