<?php

namespace App\Admin\Fields;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Elao\Enum\Bridge\Symfony\Form\Type\EnumType;

class EnumField implements FieldInterface
{
    use FieldTrait;

    /**
     * @param string|false|null $label
     */
    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('crud/field/choice')
            ->setFormType(EnumType::class)
            ->addCssClass('field-select')
            ->setCustomOption(ChoiceField::OPTION_RENDER_EXPANDED, false);
    }

    /**
     * @param class-string $enumType
     */
    public function setEnumType(string $enumType): self
    {
        $this->setFormTypeOption('enum_class', $enumType);
        return $this;
    }

}
