<?php

declare(strict_types=1);

namespace CommerceWeavers\SyliusSaferpayPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

final class SaferpayGatewayConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, ['label' => 'sylius.ui.username'])
            ->add('password', PasswordType::class, ['label' => 'sylius.ui.password'])
            ->add('customer_id', TextType::class, ['label' => 'commerce_weavers_saferpay.ui.customer_id'])
            ->add('terminal_id', TextType::class, ['label' => 'commerce_weavers_saferpay.ui.terminal_id'])
            ->add('sandbox', CheckboxType::class, ['label' => 'commerce_weavers_saferpay.ui.sandbox'])
            ->add('debug', CheckboxType::class, ['label' => 'commerce_weavers_saferpay.ui.debug'])
            ->add('allowed_payment_methods', ChoiceType::class, [
                'attr' => [
                    'class' => 'saferpay-allowed-payment-methods',
                ],
                'choices' => [
                    'Account to Account' => 'ACCOUNTTOACCOUNT',
                    'Alipay' => 'ALIPAY',
                    'American Express' => 'AMEX',
                    'Bancontact' => 'BANCONTACT',
                    'Bonus' => 'BONUS',
                    'Diners Club' => 'DINERS',
                    'Direct Debit' => 'DIRECTDEBIT',
                    'ePrzelewy' => 'EPRZELEWY',
                    'EPS' => 'EPS',
                    'Giropay' => 'GIROPAY',
                    'iDEAL' => 'IDEAL',
                    'Invoice' => 'INVOICE',
                    'JCB' => 'JCB',
                    'Klarna' => 'KLARNA',
                    'Maestro' => 'MAESTRO',
                    'Mastercard' => 'MASTERCARD',
                    'MyOne' => 'MYONE',
                    'Payconiq' => 'PAYCONIQ',
                    'Paydirekt' => 'PAYDIREKT',
                    'PayPal' => 'PAYPAL',
                    'Postcard' => 'POSTCARD',
                    'PostFinance' => 'POSTFINANCE',
                    'SOFORT' => 'SOFORT',
                    'TWINT' => 'TWINT',
                    'UnionPay' => 'UNIONPAY',
                    'Visa' => 'VISA',
                    'WLCryptoPayments' => 'WLCRYPTOPAYMENTS',
                ],
                'expanded' => true,
                'label' => 'commerce_weavers_saferpay.ui.allowed_payment_methods',
                'multiple' => true,
            ])
            ->add('use_authorize', HiddenType::class, ['data' => true])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit']);
    }

    public function onPreSubmit(PreSubmitEvent $event): void
    {
        /** @var array<string, mixed> $data */
        $data = $event->getData();
        $form = $event->getForm();

        if (!isset($data['password']) || '' === $data['password']) {
            $form->remove('password');
            $form->add('password', PasswordType::class, ['label' => 'sylius.ui.password', 'mapped' => false]);
        }
    }
}
